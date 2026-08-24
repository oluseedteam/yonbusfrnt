<?php

namespace Tests\Feature;

use App\Models\Review;
use App\Services\GoogleReviewService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GoogleReviewDisplayTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_google_places_reviews_are_enriched_with_company_names()
    {
        // Mock Google Places API config & response
        config([
            'services.google.places_api_key' => 'fake-api-key',
            'services.google.place_id'       => 'fake-place-id',
        ]);

        Http::fake([
            'https://maps.googleapis.com/maps/api/place/details/json*' => Http::response([
                'result' => [
                    'reviews' => [
                        [
                            'author_name'               => 'Adeyemi Adesanmi',
                            'profile_photo_url'         => 'https://example.com/avatar.jpg',
                            'rating'                    => 5,
                            'relative_time_description' => 'a year ago',
                            'text'                      => 'I highly recommend Yonbus tax and accounting services...',
                        ],
                        [
                            'author_name'               => 'Jane Wairimu Karanja',
                            'profile_photo_url'         => null,
                            'rating'                    => 5,
                            'relative_time_description' => '2 months ago',
                            'text'                      => 'I have had such a great experience with them from day one.',
                        ],
                    ],
                ],
            ], 200),
        ]);

        $service = app(GoogleReviewService::class);
        $reviews = $service->getReviews();

        $this->assertNotEmpty($reviews);

        // Verify Adeyemi Adesanmi has company assigned
        $adeyemi = collect($reviews)->firstWhere('name', 'Adeyemi Adesanmi');
        $this->assertNotNull($adeyemi);
        $this->assertEquals('Grand Car Wash Ltd.', $adeyemi['company']);

        // Verify Jane is in the list
        $jane = collect($reviews)->firstWhere('name', 'Jane Wairimu Karanja');
        $this->assertNotNull($jane);
    }

    public function test_reviews_render_company_on_home_and_about_pages()
    {
        // Seed a published review with company
        Review::create([
            'name'         => 'Adeyemi Adesanmi',
            'company'      => 'Grand Car Wash Ltd.',
            'location'     => 'Verified Client',
            'rating'       => 5,
            'service'      => 'Accounting & Business Advisory',
            'text'         => 'I highly recommend Yonbus tax and accounting services.',
            'source'       => 'google',
            'is_published' => true,
        ]);

        // Visit home page
        $homeResponse = $this->get('/');
        $homeResponse->assertStatus(200);
        $homeResponse->assertSee('Grand Car Wash Ltd.');
        $homeResponse->assertSee('Adeyemi Adesanmi');

        // Visit about page
        $aboutResponse = $this->get('/about');
        $aboutResponse->assertStatus(200);
        $aboutResponse->assertSee('Grand Car Wash Ltd.');
        $aboutResponse->assertSee('Adeyemi Adesanmi');
    }

    public function test_resolve_company_matches_known_business_clients()
    {
        $service = app(GoogleReviewService::class);

        $this->assertEquals('Grand Car Wash Ltd.', $service->resolveCompany('Adeyemi Adesanmi'));
        $this->assertEquals('Thurman Healthcare Services Inc.', $service->resolveCompany('Musiliu Muritala'));
        $this->assertEquals('O. Sadiku Medicine Professional Corporation', $service->resolveCompany('Olayemi Sadiku'));
    }
}
