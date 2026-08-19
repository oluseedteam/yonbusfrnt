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
                'name'         => 'Stanley B. Cooper Jr.',
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
                'location'     => 'Local Guide',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Tax Preparation & Refund Maximization',
                'text'         => 'I highly recommend Yonbus Tax & Accounting Services Inc.! They truly are the best tax preparers I’ve ever worked with. Not only are they incredibly fast and accurate, but they also have an amazing ability to maximize my refunds every year.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'anmut clothing',
                'location'     => 'Verified Review',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Corporate Tax & T4 Reporting',
                'text'         => 'Working with YonbusTaxes & Accounting Services for my tax return was a fantastic experience. They made the T4 reporting process completely painless and ensured I was maximizing my credits for the Canada Training Credit and Medical Expenses.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Jane Wairimu Karanja',
                'location'     => 'Verified Review',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Tax Filing & CRA Account Setup',
                'text'         => 'I have had such a great experience with them from day one. They helped me to create my CRA account step by step and they made the process so easy. Now they have filed my taxes and I am not using anyone else. Ooh did I mention that they are affordable too? Yes they are pocket friendly with no hidden charges!',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Adeyemi Adesanmi',
                'location'     => 'Verified Review',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Accounting & Business Advisory',
                'text'         => 'I highly recommend Yonbus tax and accounting services for their exceptional professionalism and expertise. They provide clear guidance, ensure accuracy, and always deliver on time. Their knowledge and commitment have brought great value to our business.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'James Onuoha',
                'location'     => 'Local Guide',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Tax Consultation & Resolution',
                'text'         => "YONBUS is a sure plug for all your tax issues. All my life i have always prefer to deal with professionals, and this company is one of a kind. I recommend them to friends anytime anyday. 'Follow who know road'",
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Emmanuel Adarku',
                'location'     => 'Verified Review',
                'avatar'       => null,
                'rating'       => 5,
                'service'      => 'Taxation & Accounting Services',
                'text'         => 'Am super excited about your excellent service. Yonbus Tax & Accounting Services is absolutely the best when it comes to taxation and accounting services. Nice doing business with you.',
                'source'       => 'google',
                'is_published' => true,
            ],
        ];

        foreach ($reviews as $data) {
            Review::create($data);
        }
    }
}
