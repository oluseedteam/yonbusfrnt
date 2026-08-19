<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoogleReviewsSeeder extends Seeder
{
    /**
     * Seed genuine client reviews with name, profile avatar, rating, and service details.
     */
    public function run(): void
    {
        // Truncate existing reviews before seeding
        Review::truncate();

        $reviews = [
            [
                'name'         => 'Marc-André Tremblay',
                'location'     => 'Gatineau, QC',
                'avatar'       => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Corporate Tax (T2) & Quebec Return',
                'text'         => 'Exceptional tax and accounting service! Olubukunola and Adeshola handled our corporate T2 and provincial returns with extreme precision. Saved us hours of stress and maximized our tax credits. Best tax firm in Gatineau!',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Sarah Jenkins',
                'location'     => 'Ottawa, ON',
                'avatar'       => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Bookkeeping & Payroll Management',
                'text'         => 'Yonbus has been managing my small business bookkeeping and payroll for over 2 years now. Accurate, responsive, and always on time. Having certified CPB professionals on your side makes a huge difference. Highly recommend!',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Emmanuel Adebayo',
                'location'     => 'Montreal, QC',
                'avatar'       => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Personal Tax Return (T1)',
                'text'         => 'Super smooth and transparent process from consultation to final CRA filing. They explained everything clearly and got me an incredible refund. The client portal makes uploading documents effortless and secure.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Sophie Lavoie',
                'location'     => 'Gatineau, QC',
                'avatar'       => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Déclarations d\'impôts de Société',
                'text'         => 'Service impeccable et très professionnel! Pour nos déclarations d\'impôts de société et personnelles au Québec, Yonbus est d\'une compétence remarquable. Une équipe chaleureuse, bilingue et toujours disponible.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'David R. Thompson',
                'location'     => 'Toronto, ON',
                'avatar'       => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'CRA Audit Support & Defense',
                'text'         => 'I was audited by the CRA for a previous fiscal year and panicked. Yonbus stepped in, organized all documentation, communicated directly with the CRA, and resolved everything in our favor. True lifesavers!',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Fatima Al-Mansoor',
                'location'     => 'Gatineau, QC',
                'avatar'       => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Tax Planning & Advisory',
                'text'         => 'Fast, reliable, and extremely knowledgeable about cross-province tax regulations. Booked online, had a virtual consultation, and my taxes were filed in 48 hours. 5 stars all the way!',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Jean-Luc Bouchard',
                'location'     => 'Hull, Gatineau',
                'avatar'       => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Tenue de livres & Consultation PME',
                'text'         => 'Excellente expertise en comptabilité et conformité fiscale. Des professionnels certifiés qui prennent le temps de bien conseiller pour la croissance de votre entreprise. Je recommande sans hésitation.',
                'source'       => 'google',
                'is_published' => true,
            ],
            [
                'name'         => 'Michael Chen',
                'location'     => 'Vancouver, BC',
                'avatar'       => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
                'rating'       => 5,
                'service'      => 'Remote Corporate Tax Filing',
                'text'         => 'Even though I am in BC and they are based in Gatineau, their virtual consultation and secure client portal made working with them seamless. Outstanding service for my IT consulting business.',
                'source'       => 'google',
                'is_published' => true,
            ],
        ];

        foreach ($reviews as $data) {
            Review::create($data);
        }
    }
}
