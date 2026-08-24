<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleReviewService
{
    /**
     * Known verified business client companies mapping.
     */
    protected array $knownCompanies = [
        'Adeyemi Adesanmi' => 'Grand Car Wash Ltd.',
        'Musiliu Muritala' => 'Thurman Healthcare Services Inc.',
        'Olayemi Sadiku'   => 'O. Sadiku Medicine Professional Corporation',
    ];

    /**
     * Get verified client reviews for YONBUS Tax & Accounting Services Inc.
     * Checks Google Places API, database, and verified Yonbus client testimonials.
     *
     * @return array
     */
    public function getReviews(): array
    {
        return Cache::remember('yonbus_real_reviews_v4', 3600 * 12, function () {
            $reviews = [];
            $seenNames = [];

            // Preload database published reviews map (normalized name => Review model)
            $dbReviewsMap = [];
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('reviews')) {
                    $dbRecords = Review::where('is_published', true)->orderBy('created_at', 'asc')->get();
                    foreach ($dbRecords as $dbr) {
                        $norm = $this->normalizeName($dbr->name);
                        $dbReviewsMap[$norm] = $dbr;
                    }
                }
            } catch (\Throwable $e) {
                // Ignore DB error and continue
            }

            // 1. Fetch from Google Places API if configured
            $apiKey = config('services.google.places_api_key');
            $placeId = config('services.google.place_id');

            if ($apiKey && $placeId) {
                try {
                    $response = Http::timeout(10)->get('https://maps.googleapis.com/maps/api/place/details/json', [
                        'place_id' => $placeId,
                        'fields'   => 'name,rating,reviews,user_ratings_total',
                        'key'      => $apiKey,
                    ]);

                    if ($response->successful() && isset($response->json()['result']['reviews'])) {
                        foreach ($response->json()['result']['reviews'] as $r) {
                            $authorName = $r['author_name'] ?? 'Client';
                            $norm = $this->normalizeName($authorName);
                            $company = $this->resolveCompany($authorName, $dbReviewsMap);
                            $service = $this->resolveService($authorName, $dbReviewsMap);

                            $reviews[] = [
                                'name'      => $authorName,
                                'company'   => $company,
                                'location'  => 'Google Verified',
                                'initials'  => $this->getInitials($authorName),
                                'avatar'    => $r['profile_photo_url'] ?? ($dbReviewsMap[$norm]->avatar ?? null),
                                'rating'    => (int) ($r['rating'] ?? 5),
                                'time'      => $r['relative_time_description'] ?? 'Verified Review',
                                'service'   => $service ?? 'Tax & Accounting Service',
                                'text'      => $r['text'] ?? '',
                            ];
                            $seenNames[$norm] = true;
                        }
                    }
                } catch (\Throwable $e) {
                    Log::warning('Google Places API review fetch failed: ' . $e->getMessage());
                }
            }

            // 2. Append any authentic database reviews not already present from Google Places
            if (!empty($dbReviewsMap)) {
                foreach ($dbReviewsMap as $norm => $dbr) {
                    if (!isset($seenNames[$norm])) {
                        $reviews[] = [
                            'name'      => $dbr->name,
                            'company'   => $dbr->company ?: $this->resolveCompany($dbr->name),
                            'location'  => $dbr->location ?? 'Verified Review',
                            'initials'  => $this->getInitials($dbr->name),
                            'avatar'    => $dbr->avatar,
                            'rating'    => (int) $dbr->rating,
                            'time'      => $dbr->created_at ? $dbr->created_at->diffForHumans() : 'Verified Review',
                            'service'   => $dbr->service ?? $this->resolveService($dbr->name),
                            'text'      => $dbr->text,
                        ];
                        $seenNames[$norm] = true;
                    }
                }
            }

            // 3. Append default verified business reviews if not already present
            foreach ($this->getDefaultVerifiedReviews() as $defaultRev) {
                $norm = $this->normalizeName($defaultRev['name']);
                if (!isset($seenNames[$norm])) {
                    $reviews[] = $defaultRev;
                    $seenNames[$norm] = true;
                }
            }

            // 4. Fallback if still empty
            if (empty($reviews)) {
                $reviews = $this->getDefaultVerifiedReviews();
            }

            return $reviews;
        });
    }

    /**
     * Resolve company name for a given reviewer name.
     */
    public function resolveCompany(string $name, array $dbReviewsMap = []): ?string
    {
        $norm = $this->normalizeName($name);

        // 1. Check DB map
        if (isset($dbReviewsMap[$norm]) && !empty($dbReviewsMap[$norm]->company)) {
            return $dbReviewsMap[$norm]->company;
        }

        // 2. Check known companies (exact match)
        foreach ($this->knownCompanies as $knownName => $company) {
            if ($this->normalizeName($knownName) === $norm) {
                return $company;
            }
        }

        // 3. Check partial words match (e.g. matching "Adeyemi Adesanmi")
        $nameParts = array_filter(explode(' ', strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $name))));
        foreach ($this->knownCompanies as $knownName => $company) {
            $knownParts = array_filter(explode(' ', strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $knownName))));
            if (count(array_intersect($knownParts, $nameParts)) >= 2) {
                return $company;
            }
        }

        // 4. Check default verified list
        foreach ($this->getDefaultVerifiedReviews() as $def) {
            if ($this->normalizeName($def['name']) === $norm && !empty($def['company'])) {
                return $def['company'];
            }
        }

        return null;
    }

    /**
     * Resolve service tag for a given reviewer.
     */
    protected function resolveService(string $name, array $dbReviewsMap = []): ?string
    {
        $norm = $this->normalizeName($name);
        if (isset($dbReviewsMap[$norm]) && !empty($dbReviewsMap[$norm]->service)) {
            return $dbReviewsMap[$norm]->service;
        }

        foreach ($this->getDefaultVerifiedReviews() as $def) {
            if ($this->normalizeName($def['name']) === $norm && !empty($def['service'])) {
                return $def['service'];
            }
        }

        return 'Tax & Accounting Service';
    }

    /**
     * Normalize name for case/space-insensitive matching.
     */
    protected function normalizeName(string $name): string
    {
        return strtolower(preg_replace('/[^a-zA-Z0-9]/', '', trim($name)));
    }

    /**
     * Default genuine Google reviews provided by the business.
     */
    public function getDefaultVerifiedReviews(): array
    {
        return [
            [
                'name'      => 'Olayemi Sadiku',
                'company'   => 'O. Sadiku Medicine Professional Corporation',
                'location'  => 'Verified Client',
                'initials'  => 'OS',
                'avatar'    => null,
                'rating'    => 5,
                'time'      => 'Recently',
                'service'   => 'Corporate Tax & Advisory',
                'text'      => 'Excellent, personalised service and availability',
            ],
            [
                'name'      => 'Musiliu Muritala',
                'company'   => 'Thurman Healthcare Services Inc.',
                'location'  => 'Verified Client',
                'initials'  => 'MM',
                'avatar'    => null,
                'rating'    => 5,
                'time'      => 'a day ago',
                'service'   => 'Tax Problem Consulting',
                'text'      => 'They create total solutions to your tax problems',
            ],
            [
                'name'      => 'Adeyemi Adesanmi',
                'company'   => 'Grand Car Wash Ltd.',
                'location'  => 'Verified Client',
                'initials'  => 'AA',
                'avatar'    => null,
                'rating'    => 5,
                'time'      => 'a year ago',
                'service'   => 'Accounting & Business Advisory',
                'text'      => 'I highly recommend Yonbus tax and accounting services for their exceptional professionalism and expertise. They provide clear guidance, ensure accuracy, and always deliver on time. Their knowledge and commitment have brought great value to our business, and I truly appreciate the integrity and dedication they put into every task. A trusted professional who goes above and beyond.',
            ],
            [
                'name'      => 'Stanley B. Cooper Jr.',
                'company'   => null,
                'location'  => 'Verified Review',
                'initials'  => 'SC',
                'avatar'    => null,
                'rating'    => 5,
                'time'      => '5 months ago',
                'service'   => 'Tax Filing & Advisory',
                'text'      => 'Yonbus Tax and Accounting Services Inc. is one of the best if not the best in handling tax filing business. Prior to hiring their services, I was always paying CRA back taxes that I never knew I could claim back. From my first interaction with the team, their professionalism, deep knowledge of Canadian tax laws, and dedication to getting the best possible outcome for their clients were evident.',
            ],
            [
                'name'      => 'JOHNPAUL GUMINKIRIZA',
                'company'   => null,
                'location'  => 'Local Guide',
                'initials'  => 'JG',
                'avatar'    => null,
                'rating'    => 5,
                'time'      => '5 months ago',
                'service'   => 'Tax Preparation & Refund Maximization',
                'text'      => 'I highly recommend Yonbus Tax & Accounting Services Inc.! They truly are the best tax preparers I’ve ever worked with. Not only are they incredibly fast and accurate, but they also have an amazing ability to maximize my refunds every year.',
            ],
        ];
    }

    private function getInitials(string $name): string
    {
        $words = preg_split('/\s+/', trim($name));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= strtoupper(mb_substr($w, 0, 1));
        }
        return $initials ?: 'CL';
    }
}
