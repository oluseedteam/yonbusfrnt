<?php

namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleReviewService
{
    /**
     * Get verified client reviews for YONBUS Tax & Accounting Services Inc.
     * Checks Google Places API, database, and verified Yonbus client testimonials.
     *
     * @return array
     */
    public function getReviews(): array
    {
        return Cache::remember('yonbus_real_reviews', 3600 * 12, function () {
            $reviews = [];

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
                            $reviews[] = [
                                'name'      => $r['author_name'] ?? 'Client',
                                'location'  => 'Google Verified',
                                'initials'  => $this->getInitials($r['author_name'] ?? 'CL'),
                                'avatar'    => $r['profile_photo_url'] ?? null,
                                'rating'    => (int) ($r['rating'] ?? 5),
                                'time'      => $r['relative_time_description'] ?? 'Verified Review',
                                'service'   => 'Tax & Accounting Service',
                                'text'      => $r['text'] ?? '',
                            ];
                        }
                    }
                } catch (\Throwable $e) {
                    Log::warning('Google Places API review fetch failed: ' . $e->getMessage());
                }
            }

            // 2. Fetch authentic database reviews if available
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('reviews')) {
                    $dbReviews = Review::where('is_published', true)->orderBy('created_at', 'asc')->get();
                    foreach ($dbReviews as $dbr) {
                        $reviews[] = [
                            'name'      => $dbr->name,
                            'company'   => $dbr->company ?? null,
                            'location'  => $dbr->location ?? 'Verified Review',
                            'initials'  => $this->getInitials($dbr->name),
                            'avatar'    => $dbr->avatar,
                            'rating'    => (int) $dbr->rating,
                            'time'      => $dbr->created_at ? $dbr->created_at->diffForHumans() : 'Verified Review',
                            'service'   => $dbr->service ?? 'Tax & Accounting Service',
                            'text'      => $dbr->text,
                        ];
                    }
                }
            } catch (\Throwable $e) {
                // Ignore DB error and fallback
            }

            // 3. If no external/DB reviews returned, load verified client reviews
            if (empty($reviews)) {
                $reviews = $this->getDefaultVerifiedReviews();
            }

            return $reviews;
        });
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
