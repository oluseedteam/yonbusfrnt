<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class GoogleReviewsSeeder extends Seeder
{
    /**
     * Seed genuine Google reviews provided by the business.
     */
    public function run(): void
    {
        // Truncate existing reviews before seeding
        Review::truncate();

        $reviews = [
            [
                'name'         => 'Kola Adeyemo',
                'company'      => 'G-Speed Autos Inc.',
                'location'     => 'Verified Client',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Accounting & Tax Advisory',
                'text'         => 'I highly recommend them for their professionalism, attention to detail, and reliability. They make accounting and tax matters simple, clear, and stress-free. Always responsive, knowledgeable, and genuinely committed to getting things done right. Excellent service from start to finish! ⭐️⭐️⭐️⭐️⭐️',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Olayemi Sadiku',
                'company'      => 'O. Sadiku Medicine Professional Corporation',
                'location'     => 'Verified Client',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Corporate Tax & Advisory',
                'text'         => 'Excellent, personalised service and availability',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Musiliu Muritala',
                'company'      => 'Thurman Healthcare Services Inc.',
                'location'     => 'Verified Client',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Tax Problem Consulting',
                'text'         => 'They create total solutions to your tax problems',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Adeyemi Adesanmi',
                'company'      => 'Grand Car Wash Ltd.',
                'location'     => 'Verified Client',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Accounting & Business Advisory',
                'text'         => 'I highly recommend Yonbus tax and accounting services for their exceptional professionalism and expertise. They provide clear guidance, ensure accuracy, and always deliver on time. Their knowledge and commitment have brought great value to our business.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Stanley B. Cooper Jr.',
                'company'      => null,
                'location'     => 'Verified Review',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Tax Filing & Advisory',
                'text'         => 'Yonbus Tax and Accounting Services Inc. is one of the best if not the best in handling tax filing business. Prior to hiring their services, I was always paying CRA back taxes that I never knew I could claim back. From my first interaction with the team, their professionalism, deep knowledge of Canadian tax laws, and dedication to getting the best possible outcome for their clients were evident.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'JOHNPAUL GUMINKIRIZA',
                'company'      => null,
                'location'     => 'Local Guide',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Tax Preparation & Refund Maximization',
                'text'         => 'I highly recommend Yonbus Tax & Accounting Services Inc.! They truly are the best tax preparers I’ve ever worked with. Not only are they incredibly fast and accurate, but they also have an amazing ability to maximize my refunds every year.',
                'source'       => 'google',
                'is_published' => true,
            ],
        ];

        foreach ($reviews as $data) {
            Review::create($data);
        }
    }
}
