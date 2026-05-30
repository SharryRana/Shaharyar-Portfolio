<?php

namespace Database\Seeders;

use App\Models\ClientWork;
use App\Models\FeaturedProject;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class PortfolioContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            ['Laravel Development', 'Building robust, scalable backend solutions with Laravel framework and MySQL databases.', 'fab fa-laravel', 'Backend', 1],
            ['Vue.js & Inertia.js', 'Creating dynamic, responsive frontend interfaces with Vue.js and seamless integration with Laravel.', 'fab fa-vuejs', 'Frontend', 2],
            ['React.js Development', 'Building modern, interactive user interfaces with React.js and related ecosystem.', 'fab fa-react', 'Frontend', 3],
            ['Node.js & Express', 'Developing server-side applications and RESTful APIs with Node.js and Express framework.', 'fab fa-node-js', 'Backend', 4],
            ['Database Design', 'Designing efficient database schemas and optimized queries for high-performance applications.', 'fas fa-database', 'Database', 5],
            ['VPS & Cloud Hosting', 'Deploying and managing applications on VPS and cloud platforms for optimal performance.', 'fas fa-cloud', 'Infrastructure', 6],
            ['Golang Development', 'Building fast, reliable services and APIs with Go for performance-focused systems.', 'fas fa-code', 'Backend', 7],
            ['PostgreSQL', 'Designing powerful relational data models, reporting queries, and production-ready PostgreSQL databases.', 'fas fa-database', 'Database', 8],
            ['Fintech Software', 'Secure financial workflows, ledgers, wallet systems, payment integrations, and compliance-friendly dashboards.', 'fas fa-building-columns', 'Experience', 9],
            ['Business Management Software', 'Operational tools for teams, approvals, reporting, resource management, and business process visibility.', 'fas fa-briefcase', 'Experience', 10],
            ['Marketing Software', 'SEO, campaign management, analytics dashboards, lead workflows, and growth-focused automation.', 'fas fa-bullhorn', 'Experience', 11],
            ['SaaS Applications', 'Subscription-ready web products with multi-user workflows, dashboards, billing, and scalable architecture.', 'fas fa-layer-group', 'Experience', 12],
            ['CRM/ERP Systems', 'Customer, sales, inventory, finance, and internal operations systems built around real team workflows.', 'fas fa-network-wired', 'Experience', 13],
            ['E-commerce Platforms', 'Online stores, catalogs, carts, checkout flows, payment integrations, and order management systems.', 'fas fa-shopping-cart', 'Experience', 14],
            ['Automation Tools', 'Workflow automation, integrations, scheduled jobs, data syncs, and admin tools that reduce manual work.', 'fas fa-gears', 'Experience', 15],
            ['AI-powered Web Applications', 'Practical AI features, assistants, content workflows, and intelligent automation inside business software.', 'fas fa-brain', 'Experience', 16],
        ];

        foreach ($skills as [$title, $description, $icon, $label, $sortOrder]) {
            Skill::updateOrCreate(
                ['title' => $title],
                compact('description', 'icon', 'label') + ['sort_order' => $sortOrder, 'status' => 'active']
            );
        }

        $projects = [
            ['E-Commerce Platform', 'Complete e-commerce solution with Laravel, Vue.js, and MySQL with payment integration.', 'fas fa-shopping-cart', ['Laravel', 'Vue.js', 'MySQL'], 'E-commerce Platforms', 1],
            ['Project Management App', 'Task management system with real-time updates using Laravel, Inertia.js and WebSockets.', 'fas fa-tasks', ['Laravel', 'Inertia.js', 'WebSockets'], 'Business Management Software', 2],
            ['Fitness Tracking App', 'Mobile fitness application with React Native and Firebase backend for real-time data sync.', 'fas fa-mobile-alt', ['React Native', 'Firebase', 'Node.js'], 'SaaS Applications', 3],
            ['AI Chatbot Assistant', 'Conversational AI chatbot built with Python, NLP, and OpenAI API, integrated into a customer support system.', 'fas fa-brain', ['Python', 'OpenAI API', 'NLP'], 'AI-powered Web Applications', 4],
            ['Cloud File Storage', 'Secure cloud storage system with file sharing, encryption, and AWS S3 integration.', 'fas fa-cloud', ['Laravel', 'AWS S3', 'Docker'], 'SaaS Applications', 5],
            ['Stock Market Analyzer', 'Real-time stock analysis platform with predictive analytics using Machine Learning and Node.js APIs.', 'fas fa-chart-line', ['Node.js', 'Machine Learning', 'MongoDB'], 'Fintech Software', 6],
        ];

        foreach ($projects as [$title, $description, $icon, $tags, $category, $sortOrder]) {
            FeaturedProject::updateOrCreate(
                ['title' => $title],
                [
                    'description' => $description,
                    'icon' => $icon,
                    'tags' => $tags,
                    'category' => $category,
                    'project_link' => null,
                    'sort_order' => $sortOrder,
                    'status' => 'active',
                ]
            );
        }

        $clientWorks = [
            ['Fintech Software', 'fas fa-building-columns', 'Secure financial platforms, dashboards, and payment workflows.', 'Fintech Software', 1],
            ['Restaurant Management', 'fas fa-utensils', 'Ordering, kitchen, inventory, and business operations systems.', 'Business Management Software', 2],
            ['Fashion E-commerce', 'fas fa-tshirt', 'Catalogs, checkout, order management, and customer workflows.', 'E-commerce Platforms', 3],
            ['Education Platforms', 'fas fa-book', 'Learning portals, admin dashboards, and content management tools.', 'SaaS Applications', 4],
            ['Premium Retail', 'fas fa-gem', 'Polished storefronts, CRM flows, and sales management experiences.', 'CRM/ERP Systems', 5],
            ['Travel Automation', 'fas fa-plane', 'Booking, inquiry, and process automation for travel businesses.', 'Automation Tools', 6],
            ['Marketing Software', 'fas fa-bullhorn', 'SEO, campaign, analytics, and lead management systems.', 'Marketing Software', 7],
            ['AI Web Applications', 'fas fa-brain', 'AI-assisted workflows, smart dashboards, and business automation.', 'AI-powered Web Applications', 8],
        ];

        foreach ($clientWorks as [$title, $icon, $description, $category, $sortOrder]) {
            ClientWork::updateOrCreate(
                ['title' => $title],
                [
                    'icon' => $icon,
                    'description' => $description,
                    'category' => $category,
                    'sort_order' => $sortOrder,
                    'status' => 'active',
                ]
            );
        }
    }
}
