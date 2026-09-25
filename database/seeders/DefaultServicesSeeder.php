<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Database\Seeder;

class DefaultServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name'              => 'Backend Development',
                'slug'              => 'backend-development',
                'icon'              => 'fas fa-server',
                'headline'          => 'Scalable Backend Systems Built for Production',
                'short_description' => 'Robust, high-performance backend systems using Go, Laravel, Node.js, and PostgreSQL  designed for scale.',
                'full_content'      => "Creavibe builds production-grade backend systems that handle real traffic and complex business logic.\n\nFrom RESTful APIs to event-driven architectures, we architect backend systems that are performant, maintainable, and secure. Every system is built with observability, error handling, and horizontal scalability in mind.\n\nWe work primarily with Go (Golang) for high-performance services, Laravel for rapid and robust PHP backends, Node.js for real-time applications, and PostgreSQL as our primary database. We also have deep experience with Redis, message queues (RabbitMQ, SQS), and microservice patterns.",
                'key_points'        => ['High-performance Go and Laravel backend development', 'RESTful API design with versioning and documentation', 'PostgreSQL schema design and query optimization', 'Authentication and authorization (JWT, Sanctum, OAuth)', 'Caching strategies with Redis', 'Queue-based background job processing', 'Database migrations and data integrity', 'Unit and integration testing'],
                'process_steps'     => ['Requirements analysis and system design', 'Database schema and architecture planning', 'API contract definition', 'Implementation with TDD approach', 'Code review and security audit', 'Performance testing and optimization', 'Deployment and documentation'],
                'technologies'      => ['Go (Golang)', 'Laravel', 'Node.js', 'PostgreSQL', 'MySQL', 'Redis', 'Docker', 'REST APIs', 'GraphQL', 'WebSockets'],
                'sort_order'        => 1,
                'is_active'         => true,
                'meta_title'        => 'Backend Development Services | Creavibe',
                'meta_description'  => 'Expert backend development with Go, Laravel, and PostgreSQL. Scalable APIs, database design, and production-ready systems by Creavibe.',
            ],
            [
                'name'              => 'Full-Stack Development',
                'slug'              => 'full-stack-development',
                'icon'              => 'fas fa-laptop-code',
                'headline'          => 'End-to-End Web Application Development',
                'short_description' => 'Complete web application development  from database design to user interface  using modern, production-ready technologies.',
                'full_content'      => "Creavibe delivers complete web applications from database layer to user interface.\n\nWe handle every layer: database design and optimization, backend API development, business logic, frontend implementation, authentication, admin panels, and deployment. You get a cohesive, well-integrated application rather than a patchwork of services.\n\nOur primary stack is Laravel + Vue.js or Laravel + React for modern SPAs, and Laravel + Blade for server-rendered applications. We choose the right approach for each project based on SEO requirements, user experience goals, and performance needs.",
                'key_points'        => ['Complete full-stack development from scratch', 'Laravel + Vue.js / React / Blade combinations', 'Responsive, mobile-first UI development', 'Admin panel and dashboard development', 'User authentication and role-based access control', 'Third-party API integrations', 'Performance optimization and SEO', 'Deployment and DevOps support'],
                'process_steps'     => ['Project requirements and scope definition', 'UX wireframing and technical architecture', 'Database design', 'Backend API development', 'Frontend implementation', 'Integration and testing', 'Deployment and handover'],
                'technologies'      => ['Laravel', 'Vue.js', 'React', 'Inertia.js', 'Tailwind CSS', 'PostgreSQL', 'MySQL', 'Alpine.js', 'Vite', 'Docker'],
                'sort_order'        => 2,
                'is_active'         => true,
                'meta_title'        => 'Full-Stack Development Services | Creavibe',
                'meta_description'  => 'Full-stack web application development with Laravel, Vue.js, and React. Complete development from database to UI by Creavibe.',
            ],
            [
                'name'              => 'SaaS Development',
                'slug'              => 'saas-development',
                'icon'              => 'fas fa-layer-group',
                'headline'          => 'Build Your SaaS Product the Right Way',
                'short_description' => 'Complete SaaS product development  from MVP to production  including multi-tenancy, billing, user management, and scalable architecture.',
                'full_content'      => "Building a SaaS product is fundamentally different from building a standard web application. Creavibe specializes in SaaS-specific architecture patterns that let your product scale without major rewrites.\n\nWe implement multi-tenancy (database-per-tenant or shared database with row-level isolation), subscription billing with Stripe, feature flags, usage metering, user onboarding flows, team and organization management, and all the infrastructure that makes a SaaS product viable.\n\nWe've built multiple SaaS products in FinTech, marketing, and business management. We understand the architecture decisions that matter in the early stages and which shortcuts will hurt you at scale.",
                'key_points'        => ['Multi-tenant SaaS architecture design', 'Subscription billing with Stripe / payment gateways', 'User onboarding and team management', 'Feature flags and plan-based access control', 'Usage metering and analytics', 'SaaS admin dashboard development', 'Scalable database design for multi-tenancy', 'SaaS-specific security and data isolation'],
                'process_steps'     => ['SaaS architecture planning and technology selection', 'Core authentication and multi-tenancy foundation', 'Billing and subscription implementation', 'Feature development and user flows', 'Admin and analytics dashboard', 'Testing, QA, and performance audit', 'Launch and post-launch support'],
                'technologies'      => ['Laravel', 'Go', 'Vue.js', 'React', 'PostgreSQL', 'Stripe', 'Redis', 'Docker', 'Tailwind CSS', 'Laravel Cashier'],
                'sort_order'        => 3,
                'is_active'         => true,
                'meta_title'        => 'SaaS Development Services | Creavibe',
                'meta_description'  => 'Expert SaaS product development with multi-tenancy, billing, and scalable architecture. Build your SaaS product with Creavibe.',
            ],
            [
                'name'              => 'API Development',
                'slug'              => 'api-development',
                'icon'              => 'fas fa-plug',
                'headline'          => 'Clean, Well-Documented APIs That Scale',
                'short_description' => 'RESTful and GraphQL API development with proper versioning, authentication, rate limiting, and comprehensive documentation.',
                'full_content'      => "APIs are the foundation of modern software. Creavibe designs and builds APIs that are clean, consistent, secure, and documented  APIs that developers actually enjoy using.\n\nWe follow REST best practices: consistent naming, proper HTTP methods, meaningful status codes, pagination, filtering, rate limiting, and versioning. Every API comes with OpenAPI/Swagger documentation.\n\nFor high-performance scenarios, we build APIs in Go. For Laravel-based systems, we use Laravel's API resources and follow established conventions. We also have experience with GraphQL for complex data requirements.",
                'key_points'        => ['RESTful API design and implementation', 'GraphQL API development', 'API authentication (JWT, OAuth2, API Keys, Sanctum)', 'Rate limiting and throttling', 'API versioning strategies', 'OpenAPI / Swagger documentation', 'Third-party API integrations', 'API performance optimization and caching'],
                'process_steps'     => ['API contract design and review', 'Authentication and security architecture', 'Endpoint implementation', 'Rate limiting and middleware setup', 'Testing with automated test suite', 'Documentation generation', 'Deployment and monitoring setup'],
                'technologies'      => ['Go', 'Laravel', 'Node.js', 'REST', 'GraphQL', 'JWT', 'OAuth2', 'OpenAPI', 'Postman', 'Redis'],
                'sort_order'        => 4,
                'is_active'         => true,
                'meta_title'        => 'API Development Services | Creavibe',
                'meta_description'  => 'RESTful and GraphQL API development with proper auth, versioning, and documentation. Expert API development by Creavibe.',
            ],
            [
                'name'              => 'FinTech Development',
                'slug'              => 'fintech-development',
                'icon'              => 'fas fa-building-columns',
                'headline'          => 'Financial Software Built for Accuracy and Compliance',
                'short_description' => 'FinTech system development  payment processing, transaction engines, financial dashboards, and compliance-ready business logic.',
                'full_content'      => "Financial software has zero tolerance for errors. Creavibe builds FinTech systems with the rigor that financial data demands  proper transaction handling, idempotency, audit trails, and data accuracy at every layer.\n\nWe've built payment processing integrations, multi-currency transaction engines, reconciliation systems, financial reporting dashboards, and billing systems. We understand double-entry bookkeeping principles, ACID transactions, and the importance of proper error handling in financial contexts.\n\nFor payment integrations, we work with Stripe, PayPal, and local payment gateway APIs. We build with PostgreSQL for its superior support for complex transactions and data integrity constraints.",
                'key_points'        => ['Payment gateway integrations (Stripe, PayPal, and more)', 'Multi-currency transaction processing', 'Financial reporting and analytics dashboards', 'Reconciliation and audit trail systems', 'Idempotent API design for financial operations', 'ACID-compliant transaction processing', 'Billing and subscription systems', 'Compliance-ready data architecture'],
                'process_steps'     => ['Financial requirements analysis and compliance review', 'Data model and transaction flow design', 'Payment integration and testing in sandbox', 'Core financial logic implementation', 'Audit logging and reconciliation tools', 'Security audit and penetration testing', 'Production deployment and monitoring'],
                'technologies'      => ['Go', 'Laravel', 'PostgreSQL', 'Stripe', 'PayPal', 'Redis', 'Docker', 'WebSockets', 'REST APIs'],
                'sort_order'        => 5,
                'is_active'         => true,
                'meta_title'        => 'FinTech Development Services | Creavibe',
                'meta_description'  => 'FinTech software development  payment processing, financial systems, and compliance-ready business logic by Creavibe.',
            ],
        ];

        foreach ($services as $data) {
            Service::firstOrCreate(['slug' => $data['slug']], $data);
        }

        $this->command->info('Default services seeded successfully.');
    }
}
