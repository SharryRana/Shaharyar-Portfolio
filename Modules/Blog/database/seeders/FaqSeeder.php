<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Seed default FAQ entries.
     */
    public function run(): void
    {
        $faqs = [
            [
                'category' => Faq::CATEGORY_GENERAL,
                'question' => 'What is Creavibe?',
                'answer' => 'Creavibe is a digital PR and link building platform that connects advertisers with trusted publishers for content placements, guest posts, and authority backlinks.',
                'order' => 1,
            ],
            [
                'category' => Faq::CATEGORY_GENERAL,
                'question' => 'How does Creavibe keep placements safe?',
                'answer' => 'Creavibe focuses on real websites, clear communication, manual quality checks, and transparent placement details before an order is confirmed.',
                'order' => 2,
            ],
            [
                'category' => Faq::CATEGORY_GENERAL,
                'question' => 'Can I contact support before ordering?',
                'answer' => 'Yes. You can contact the Creavibe team before starting an order if you need help choosing publishers, understanding requirements, or reviewing campaign fit.',
                'order' => 3,
            ],
            [
                'category' => Faq::CATEGORY_ADVERTISER,
                'question' => 'How do advertisers place an order?',
                'answer' => 'Advertisers can browse publisher opportunities, compare metrics, select a suitable placement, submit content requirements, and track the order from submission to completion.',
                'order' => 1,
            ],
            [
                'category' => Faq::CATEGORY_ADVERTISER,
                'question' => 'Can advertisers choose a niche?',
                'answer' => 'Yes. Advertisers can filter opportunities by niche, website category, audience fit, authority metrics, pricing, and placement type.',
                'order' => 2,
            ],
            [
                'category' => Faq::CATEGORY_ADVERTISER,
                'question' => 'Do advertisers need to provide content?',
                'answer' => 'Advertisers may provide their own article or request content support depending on the selected publisher and campaign requirements.',
                'order' => 3,
            ],
            [
                'category' => Faq::CATEGORY_PUBLISHER,
                'question' => 'How do publishers join Creavibe?',
                'answer' => 'Publishers can register, add their website details, submit traffic and category information, and wait for review before listings become available to advertisers.',
                'order' => 1,
            ],
            [
                'category' => Faq::CATEGORY_PUBLISHER,
                'question' => 'Can publishers set their own pricing?',
                'answer' => 'Yes. Publishers can define pricing based on placement type, site authority, editorial effort, turnaround time, and content requirements.',
                'order' => 2,
            ],
            [
                'category' => Faq::CATEGORY_PUBLISHER,
                'question' => 'When do publishers receive payment?',
                'answer' => 'Publisher payments are processed after the placement is delivered, reviewed, and approved according to the platform payment workflow.',
                'order' => 3,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                [
                    'category' => $faq['category'],
                    'question' => $faq['question'],
                ],
                [
                    'answer' => $faq['answer'],
                    'order' => $faq['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
