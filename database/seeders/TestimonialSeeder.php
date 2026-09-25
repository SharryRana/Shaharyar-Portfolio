<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Alexander Wright',
                'client_title' => 'Founder & CEO',
                'company_name' => 'Vanguard SaaS Solutions',
                'rating' => 5,
                'review' => 'Shaharyar delivered our SaaS MVP ahead of schedule with exceptional Laravel backend architecture. The system easily scales under heavy concurrent requests and the API design was flawless.',
                'project_title' => 'SaaS Infrastructure & Backend API',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Elena Rostova',
                'client_title' => 'Head of Engineering',
                'company_name' => 'Apex Digital Ventures',
                'rating' => 5,
                'review' => 'Working with Creavibe was a game-changer for our inventory and distribution management platform. Complex business logic was turned into clean, maintainable code with high test coverage.',
                'project_title' => 'Distribution Management Platform',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Marcus Vance',
                'client_title' => 'Product Director',
                'company_name' => 'FinLedger Global',
                'rating' => 5,
                'review' => 'Creavibe handled our FinTech ledger integration with precision. Their deep knowledge of Go microservices, database transaction safety, and clean architecture exceeded all our expectations.',
                'project_title' => 'FinTech Wallet & Ledger System',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'client_name' => 'Sarah Jenkins',
                'client_title' => 'VP of Operations',
                'company_name' => 'LogiTech Enterprise',
                'rating' => 5,
                'review' => 'Highly professional, clear communication, and outstanding technical execution. Creavibe built our automated booking engine with smooth UX and robust backend performance.',
                'project_title' => 'Automated Order Booking System',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['client_name' => $data['client_name'], 'company_name' => $data['company_name']],
                $data
            );
        }
    }
}
