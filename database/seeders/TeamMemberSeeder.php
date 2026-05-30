<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Shaharyar Rana',
                'role' => 'Full Stack Software Engineer',
                'experience_label' => '5+ Years Experience',
                'projects_label' => '500+ Projects',
                'description' => 'I architect and build enterprise-grade software solutions that drive measurable business outcomes. I specialize in transforming complex business requirements into elegant, scalable systems that stand the test of time.',
                'mission' => 'Turn your business challenges into competitive advantages through custom software that your team will actually love using.',
                'tags' => ['Enterprise Dashboards', 'Workflow Automation'],
                'expertise' => ['Enterprise Dashboards', 'Workflow Automation', 'Backend Architecture', 'Premium UI/UX', 'Cloud Infrastructure'],
                'stats' => ['500+ Projects Delivered', '100% Client Satisfaction'],
                'phone' => '+92 305 7362625',
                'email' => 'ranashaharyar625@gmail.com',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'Mashood Ali Khan',
                'role' => 'Software Engineer | Core Team Member',
                'experience_label' => null,
                'projects_label' => '300+ Projects',
                'description' => 'A dedicated software engineer with exceptional attention to detail and a strong focus on quality. Mashood ensures every feature is functional, optimized, maintainable, and reliable.',
                'mission' => null,
                'tags' => ['Performance Expert', 'Code Quality'],
                'expertise' => ['Backend Development', 'Performance Optimization', 'Quality Assurance', 'System Integration'],
                'stats' => ['300+ Projects Delivered', '99.9% Code Quality'],
                'phone' => '+92 300 4206610',
                'email' => 'mashood@example.com',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Zohaib Awan',
                'role' => 'SQA & Marketing Manager',
                'experience_label' => '1+ Year Experience',
                'projects_label' => '50+ Projects',
                'description' => 'A dedicated Software Quality Assurance professional and Marketing Manager focused on delivering high-quality software and driving impactful marketing initiatives.',
                'mission' => null,
                'tags' => ['SQA', 'Marketing', 'SEO'],
                'expertise' => ['Software Quality Assurance', 'Marketing & SEO Management', 'Process Optimization', 'Performance Analysis'],
                'stats' => ['50+ Projects Delivered', '100% Client Satisfaction'],
                'phone' => '+92 310 6796858',
                'email' => 'awanzohaib045@gmail.com',
                'status' => 'active',
                'sort_order' => 3,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(
                ['email' => $member['email']],
                $member
            );
        }
    }
}
