<?php

namespace Database\Seeders;

use App\Models\SaasProduct;
use App\Models\SaasProductCountryPrice;
use App\Models\SaasProductFaq;
use App\Models\SaasProductFeature;
use App\Models\SaasProductPricingPlan;
use App\Models\SaasProductScreenshot;
use Illuminate\Database\Seeder;

class SaasProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'title' => 'TradeFlow CRM',
                'slug' => 'tradeflow-crm',
                'tagline' => 'A premium CRM and workflow automation SaaS for sales, support, and operations teams.',
                'category' => 'CRM/ERP Systems',
                'icon' => 'fas fa-network-wired',
                'overview' => 'TradeFlow CRM centralizes leads, customers, follow-ups, task ownership, reporting, and team workflows in one clean dashboard built for growing service businesses.',
                'how_it_works' => 'Teams capture leads, assign ownership, track pipeline stages, automate follow-ups, and view performance dashboards without jumping between spreadsheets and chat threads.',
                'access_instructions' => 'Request a demo, choose a plan, and get a configured workspace with user roles, pipeline stages, and reporting dashboards tailored to your process.',
                'benefits' => ['Centralized sales and support workflows', 'Cleaner reporting for managers', 'Reduced manual follow-up work', 'Role-based team visibility'],
                'use_cases' => ['Lead management', 'Sales pipelines', 'Customer support workflows', 'Team performance reporting'],
                'tech_stack' => ['Laravel', 'Vue.js', 'PostgreSQL', 'Redis', 'AWS'],
                'focus_keyword' => 'CRM workflow automation SaaS',
                'sort_order' => 1,
                'features' => [
                    ['Pipeline Automation', 'Automate stages, reminders, and ownership across every deal.', 'fas fa-diagram-project'],
                    ['Smart Dashboards', 'Track leads, tasks, conversion, and team performance in real time.', 'fas fa-chart-line'],
                    ['Role-Based Access', 'Give every department only the tools and data they need.', 'fas fa-user-shield'],
                ],
                'faqs' => [
                    ['Can I customize pipeline stages?', 'Yes, pipeline stages, roles, labels, and reporting views can be configured for your workflow.'],
                    ['Is it suitable for small teams?', 'Yes. It works for small teams and can scale into larger business operations.'],
                ],
                'plans' => [
                    ['Basic', 29, 'USD', 'monthly', 'Start Basic', 'For small teams validating a cleaner CRM workflow.', ['3 users', 'Lead tracking', 'Basic dashboard'], false],
                    ['Pro', 79, 'USD', 'monthly', 'Start Pro', 'For growing teams that need automation and better reporting.', ['15 users', 'Automation workflows', 'Advanced reporting'], true],
                    ['Enterprise', 199, 'USD', 'monthly', 'Talk to Sales', 'For larger teams with custom workflows and priority support.', ['Unlimited users', 'Custom workflows', 'Priority support'], false],
                ],
                'country_prices' => [
                    ['Basic', 'PK', 'Pakistan', 'PKR', 8500],
                    ['Pro', 'PK', 'Pakistan', 'PKR', 22500],
                    ['Enterprise', 'PK', 'Pakistan', 'PKR', 56000],
                    ['Basic', 'AE', 'UAE', 'AED', 109],
                    ['Pro', 'AE', 'UAE', 'AED', 289],
                ],
                'screenshots' => [
                    ['Dashboard Overview', 'TradeFlow CRM dashboard overview screenshot'],
                    ['Pipeline Workflow', 'TradeFlow CRM pipeline workflow screenshot'],
                ],
            ],
            [
                'title' => 'LedgerPay Fintech Suite',
                'slug' => 'ledgerpay-fintech-suite',
                'tagline' => 'A fintech operations SaaS for wallets, ledgers, payment tracking, and financial dashboards.',
                'category' => 'Fintech Software',
                'icon' => 'fas fa-building-columns',
                'overview' => 'LedgerPay Fintech Suite helps financial teams manage transaction workflows, account balances, reconciliation views, payment statuses, and operational reporting.',
                'how_it_works' => 'Transactions flow through controlled ledger states, dashboards reveal settlement and reconciliation issues, and finance teams can audit operational data from a single interface.',
                'access_instructions' => 'Book a private demo to review modules, compliance needs, integration scope, and deployment options.',
                'benefits' => ['Clear transaction visibility', 'Audit-ready operational logs', 'Faster reconciliation', 'Custom integrations with payment providers'],
                'use_cases' => ['Wallet systems', 'Payment operations', 'Settlement dashboards', 'Finance team tooling'],
                'tech_stack' => ['Laravel', 'Golang', 'PostgreSQL', 'Queue Workers', 'Docker'],
                'focus_keyword' => 'fintech ledger SaaS',
                'sort_order' => 2,
                'features' => [
                    ['Ledger Workflows', 'Track credits, debits, transfers, and reconciliation states.', 'fas fa-receipt'],
                    ['Payment Status Tracking', 'Monitor provider callbacks, pending items, and failed payment flows.', 'fas fa-money-bill-transfer'],
                    ['Finance Dashboards', 'Give operations teams the data they need to move quickly.', 'fas fa-chart-pie'],
                ],
                'faqs' => [
                    ['Can this integrate with existing payment gateways?', 'Yes, integrations can be built around your provider APIs and operational rules.'],
                    ['Does it replace accounting software?', 'It is designed for operational fintech workflows and can integrate with accounting tools when needed.'],
                ],
                'plans' => [
                    ['Basic', 49, 'USD', 'monthly', 'Start Basic', 'For fintech teams starting with operational dashboards.', ['Core dashboards', 'Manual exports', 'Email support'], false],
                    ['Pro', 149, 'USD', 'monthly', 'Start Pro', 'For teams that need integrations and deeper audit visibility.', ['Provider integrations', 'Advanced logs', 'Priority support'], true],
                    ['Enterprise', 399, 'USD', 'monthly', 'Book Demo', 'For private deployments and custom fintech workflows.', ['Custom modules', 'SLA support', 'Private deployment'], false],
                ],
                'country_prices' => [
                    ['Basic', 'PK', 'Pakistan', 'PKR', 14000],
                    ['Pro', 'PK', 'Pakistan', 'PKR', 42000],
                    ['Enterprise', 'PK', 'Pakistan', 'PKR', 112000],
                ],
                'screenshots' => [
                    ['Ledger Dashboard', 'LedgerPay Fintech Suite ledger dashboard screenshot'],
                    ['Payment Operations', 'LedgerPay payment operations screenshot'],
                ],
            ],
            [
                'title' => 'MarketPilot Automation',
                'slug' => 'marketpilot-automation',
                'tagline' => 'A marketing automation SaaS for campaigns, lead funnels, analytics, and SEO operations.',
                'category' => 'Marketing Software',
                'icon' => 'fas fa-bullhorn',
                'overview' => 'MarketPilot Automation gives marketing teams a clean platform to organize campaigns, track leads, monitor SEO tasks, and measure growth workflows.',
                'how_it_works' => 'Campaigns, lead sources, tasks, SEO checks, and analytics are organized into simple views so teams can execute consistently and see what is working.',
                'access_instructions' => 'Start with a demo workspace, connect your campaign sources, and configure task templates for your team.',
                'benefits' => ['Better campaign visibility', 'SEO task control', 'Lead funnel tracking', 'Team execution consistency'],
                'use_cases' => ['Campaign management', 'SEO workflows', 'Lead tracking', 'Marketing dashboards'],
                'tech_stack' => ['Laravel', 'React', 'PostgreSQL', 'OpenAI API', 'Analytics APIs'],
                'focus_keyword' => 'marketing automation SaaS',
                'sort_order' => 3,
                'features' => [
                    ['Campaign Boards', 'Plan and track campaigns with ownership and due dates.', 'fas fa-calendar-check'],
                    ['SEO Operations', 'Manage SEO tasks, audits, and content workflow priorities.', 'fas fa-magnifying-glass-chart'],
                    ['AI Content Assist', 'Use AI-assisted workflows for briefs, content ideas, and summaries.', 'fas fa-brain'],
                ],
                'faqs' => [
                    ['Can this manage SEO tasks?', 'Yes, it can organize SEO checklists, content workflows, and performance review tasks.'],
                    ['Can AI features be disabled?', 'Yes, AI workflows can be optional depending on your team preference.'],
                ],
                'plans' => [
                    ['Basic', 19, 'USD', 'monthly', 'Start Basic', 'For organizing simple campaigns and reports.', ['Campaign board', 'Basic reports', '5 users'], false],
                    ['Pro', 59, 'USD', 'monthly', 'Start Pro', 'For marketing teams using SEO workflows and AI assists.', ['AI assists', 'SEO workflows', '20 users'], true],
                    ['Enterprise', 149, 'USD', 'monthly', 'Book Demo', 'For agencies and teams needing custom integrations.', ['Custom integrations', 'Unlimited users', 'Priority support'], false],
                ],
                'country_prices' => [
                    ['Basic', 'PK', 'Pakistan', 'PKR', 5500],
                    ['Pro', 'PK', 'Pakistan', 'PKR', 17000],
                    ['Enterprise', 'PK', 'Pakistan', 'PKR', 42000],
                ],
                'screenshots' => [
                    ['Campaign Dashboard', 'MarketPilot Automation campaign dashboard screenshot'],
                    ['SEO Workflow', 'MarketPilot Automation SEO workflow screenshot'],
                ],
            ],
        ];

        foreach ($products as $data) {
            $product = SaasProduct::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'title' => $data['title'],
                    'tagline' => $data['tagline'],
                    'overview' => $data['overview'],
                    'how_it_works' => $data['how_it_works'],
                    'access_instructions' => $data['access_instructions'],
                    'icon' => $data['icon'],
                    'category' => $data['category'],
                    'video_url' => null,
                    'benefits' => $data['benefits'],
                    'use_cases' => $data['use_cases'],
                    'tech_stack' => $data['tech_stack'],
                    'sort_order' => $data['sort_order'],
                    'status' => 'active',
                    'meta_title' => $data['title'] . ' | SaaS Product Demo',
                    'meta_description' => $data['tagline'],
                    'meta_keywords' => implode(', ', array_merge([$data['focus_keyword']], $data['tech_stack'])),
                    'og_title' => $data['title'],
                    'og_description' => $data['tagline'],
                    'twitter_title' => $data['title'],
                    'twitter_description' => $data['tagline'],
                    'focus_keyword' => $data['focus_keyword'],
                    'thumbnail_alt' => $data['title'] . ' SaaS product dashboard preview',
                ]
            );

            $product->features()->delete();
            foreach ($data['features'] as $index => [$title, $description, $icon]) {
                SaasProductFeature::create(compact('title', 'description', 'icon') + [
                    'saas_product_id' => $product->id,
                    'sort_order' => $index + 1,
                ]);
            }

            $product->faqs()->delete();
            foreach ($data['faqs'] as $index => [$question, $answer]) {
                SaasProductFaq::create(compact('question', 'answer') + [
                    'saas_product_id' => $product->id,
                    'sort_order' => $index + 1,
                ]);
            }

            $product->screenshots()->delete();
            foreach ($data['screenshots'] as $index => [$title, $altText]) {
                SaasProductScreenshot::create([
                    'saas_product_id' => $product->id,
                    'image' => 'favicon/web-app-manifest-512x512.png',
                    'alt_text' => $altText,
                    'title' => $title,
                    'sort_order' => $index + 1,
                ]);
            }

            $product->pricingPlans()->delete();
            $plans = [];
            foreach ($data['plans'] as $index => [$title, $price, $currency, $duration, $ctaLabel, $description, $features, $isPopular]) {
                $plans[$title] = SaasProductPricingPlan::create([
                    'saas_product_id' => $product->id,
                    'title' => $title,
                    'price' => $price,
                    'currency' => $currency,
                    'duration' => $duration,
                    'description' => $description,
                    'cta_label' => $ctaLabel,
                    'features' => $features,
                    'is_popular' => $isPopular,
                    'status' => 'active',
                    'sort_order' => $index + 1,
                ]);
            }

            foreach ($data['country_prices'] as [$planTitle, $code, $country, $currency, $price]) {
                if (isset($plans[$planTitle])) {
                    SaasProductCountryPrice::create([
                        'saas_product_pricing_plan_id' => $plans[$planTitle]->id,
                        'country_code' => $code,
                        'country_name' => $country,
                        'currency' => $currency,
                        'price' => $price,
                    ]);
                }
            }
        }
    }
}
