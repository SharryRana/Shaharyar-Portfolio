<?php

namespace Modules\Blog\Database\Seeders;

use Modules\Blog\Models\Article;
use Modules\Blog\Models\Author;
use Modules\Blog\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            'Safdar Ali' => [
                'designation' => 'SEO Strategist',
                'bio' => 'Writes practical guides about link building, digital PR, and scalable publisher workflows.',
            ],
            'Charles Floate' => [
                'designation' => 'Publisher Growth Advisor',
                'bio' => 'Covers publisher monetization, sponsored content operations, and advertiser relationships.',
            ],
            'James Dooley' => [
                'designation' => 'Advertising Strategist',
                'bio' => 'Shares advertising, campaign measurement, and ROI strategy for performance-focused teams.',
            ],
            'Sarah Mills' => [
                'designation' => 'Editorial SEO Writer',
                'bio' => 'Explains editorial links, content quality, and sustainable SEO practices.',
            ],
        ];

        $authorIds = collect($authors)
            ->mapWithKeys(function (array $author, string $name): array {
                $model = Author::withTrashed()->updateOrCreate(
                    ['name' => $name],
                    array_merge($author, [
                        'avatar' => null,
                        'signature' => null,
                        'is_active' => true,
                    ])
                );

                if ($model->trashed()) {
                    $model->restore();
                }

                return [$name => $model->id];
            });

        $categories = [
            Article::CATEGORY_LINK_BUILDING => [
                'description' => 'Guides and insights about backlinks, guest posting, editorial links, and SEO authority building.',
                'meta_title' => 'Link Building Articles | Creavibe',
                'meta_description' => 'Read Creavibe articles about link building, backlinks, guest posts, and digital PR workflows.',
                'meta_keywords' => 'link building, backlinks, guest posts, digital pr',
            ],
            Article::CATEGORY_PUBLISHER => [
                'description' => 'Resources for publishers who want to grow revenue and manage advertiser relationships.',
                'meta_title' => 'Publisher Articles | Creavibe',
                'meta_description' => 'Read Creavibe articles for publishers about monetization, placements, and advertiser partnerships.',
                'meta_keywords' => 'publisher revenue, monetization, sponsored posts',
            ],
            Article::CATEGORY_ADVERTISER => [
                'description' => 'Resources for advertisers planning campaigns, placements, and performance-focused partnerships.',
                'meta_title' => 'Advertiser Articles | Creavibe',
                'meta_description' => 'Read Creavibe articles for advertisers about campaign strategy, publisher selection, and ROI.',
                'meta_keywords' => 'advertisers, campaign roi, publisher placements',
            ],
        ];

        $categoryIds = collect($categories)
            ->mapWithKeys(function (array $category, string $name): array {
                $model = BlogCategory::withTrashed()->updateOrCreate(
                    ['slug' => Str::slug($name)],
                    array_merge($category, [
                        'name' => $name,
                        'is_active' => true,
                    ])
                );

                if ($model->trashed()) {
                    $model->restore();
                }

                return [$name => $model->id];
            });

        $articles = [
            [
                'category' => Article::CATEGORY_LINK_BUILDING,
                'title' => 'How To Buy Backlinks The Complete Guide For 2026',
                'slug' => 'how-to-buy-backlinks-complete-guide-2026',
                'excerpt' => 'Learn how to buy backlinks safely in 2026, what to avoid, and how to build high-quality links that actually improve rankings.',
                'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1600&q=80',
                'image_title' => 'SEO backlink strategy workspace',
                'image_alt_text' => 'Digital marketing workspace showing backlink strategy planning',
                'image_description' => 'A professional workspace image used for a Creavibe guide about buying backlinks safely and building high-quality links.',
                'image_caption' => 'Plan backlink campaigns around relevance, quality, and editorial standards.',
                'author_name' => 'Safdar Ali',
                'published_at' => '2026-03-31 10:00:00',
                'meta_keywords' => 'backlinks, link building, seo',
                'show_on_blog' => true,
                'is_trending' => true,
                'content' => <<<'HTML'
<h2>The Best Way To Buy Backlinks In 2026</h2>
<p>Buying backlinks can still support SEO growth when the process is built around relevance, editorial quality, and real publisher standards. The goal is not to buy random links. The goal is to earn placements on websites that make sense for your audience.</p>
<h2>What Makes A Backlink Worth Buying?</h2>
<p>A strong backlink usually comes from a real website with topical relevance, visible traffic, indexed content, and a clean publishing history. Before ordering, review the publication category, editorial style, expected turnaround, and placement rules.</p>
<h3>Quality Signals To Check</h3>
<ul>
<li>Relevant audience and niche alignment</li>
<li>Organic traffic from trusted SEO tools</li>
<li>Editorial content that reads naturally</li>
<li>Clear placement expectations before payment</li>
</ul>
<h2>Common Mistakes To Avoid</h2>
<p>Avoid buying links only because the domain metric is high. Metrics help, but context matters more. A smaller relevant publisher is often more useful than a large unrelated website with weak editorial standards.</p>
<h2>How Creavibe Helps</h2>
<p>Creavibe helps advertisers compare publisher opportunities, review placement expectations, and manage orders in one workflow. This keeps link building organized while reducing manual back-and-forth.</p>
<h2>Conclusion</h2>
<p>The safest approach is to build slowly, prioritize relevance, and use publishers that care about content quality. Done properly, backlink buying becomes a structured digital PR workflow rather than a risky shortcut.</p>
HTML,
            ],
            [
                'category' => Article::CATEGORY_PUBLISHER,
                'title' => 'How to Grow Your Publisher Revenue in 2026',
                'slug' => 'grow-publisher-revenue-2026',
                'excerpt' => 'Discover practical monetisation strategies publishers can use to increase revenue and build stronger advertiser relationships.',
                'image' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1600&q=80',
                'image_title' => 'Publisher revenue growth newsroom',
                'image_alt_text' => 'Publisher team reviewing content and revenue opportunities',
                'image_description' => 'A newsroom-style image used for a Creavibe article about growing publisher revenue and improving advertiser relationships.',
                'image_caption' => 'Clear positioning helps publishers turn audience quality into stronger revenue.',
                'author_name' => 'Charles Floate',
                'published_at' => '2026-04-10 10:00:00',
                'meta_keywords' => 'publisher revenue, monetization, guest posts',
                'show_on_blog' => true,
                'is_trending' => false,
                'content' => <<<'HTML'
<h2>Publisher Revenue Starts With Positioning</h2>
<p>Publishers earn more when their listings clearly explain audience quality, editorial standards, turnaround time, and available placement types. Advertisers want confidence before they place an order.</p>
<h2>Build Packages Advertisers Understand</h2>
<p>Create simple offers that match common campaign goals. A clear guest post option, a homepage feature, or a niche editorial placement is easier to buy than a vague custom service.</p>
<ul>
<li>Show examples of accepted content types</li>
<li>Define turnaround expectations</li>
<li>Keep pricing transparent</li>
<li>Respond quickly to placement questions</li>
</ul>
<h2>Keep Quality Consistent</h2>
<p>Strong publisher relationships come from consistent delivery. Publish on time, keep links live, and communicate early if requirements need adjustment.</p>
HTML,
            ],
            [
                'category' => Article::CATEGORY_ADVERTISER,
                'title' => 'The Ultimate Guide to Display Advertising ROI',
                'slug' => 'display-advertising-roi-guide',
                'excerpt' => 'Learn how advertisers can improve campaign returns through better targeting, creative testing, and publisher selection.',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1600&q=80',
                'image_title' => 'Advertising ROI analytics dashboard',
                'image_alt_text' => 'Analytics dashboard used to measure advertising campaign ROI',
                'image_description' => 'A campaign analytics image used for a Creavibe guide about improving display advertising ROI through better targeting and testing.',
                'image_caption' => 'Better targeting and measurement make advertiser campaigns easier to scale.',
                'author_name' => 'James Dooley',
                'published_at' => '2026-04-05 10:00:00',
                'meta_keywords' => 'advertising roi, advertisers, campaigns',
                'show_on_blog' => true,
                'is_trending' => false,
                'content' => <<<'HTML'
<h2>ROI Depends On Fit</h2>
<p>Advertisers get better results when the publisher audience matches the campaign intent. Relevance, content angle, and offer quality are often more important than raw traffic numbers.</p>
<h2>Test Before Scaling</h2>
<p>Start with a smaller group of placements, compare engagement, and then expand into similar publishers. This makes budget decisions easier and reduces wasted spend.</p>
<h2>Measure The Right Signals</h2>
<ul>
<li>Referral traffic quality</li>
<li>Keyword movement over time</li>
<li>Lead quality from placements</li>
<li>Publisher responsiveness</li>
</ul>
HTML,
            ],
            [
                'category' => Article::CATEGORY_LINK_BUILDING,
                'title' => 'Editorial Links: What Are They and How to Build Them',
                'slug' => 'editorial-links-how-to-build-them',
                'excerpt' => 'Editorial links are the gold standard of SEO. This guide explains how to attract and manage them at scale.',
                'image' => 'https://images.unsplash.com/photo-1432888498266-38ffec3eaf0a?auto=format&fit=crop&w=1600&q=80',
                'image_title' => 'Editorial link building research desk',
                'image_alt_text' => 'Laptop workspace for researching editorial link opportunities',
                'image_description' => 'A research workspace image used for a Creavibe guide explaining editorial links and how to build them at scale.',
                'image_caption' => 'Editorial links work best when they add context and value for readers.',
                'author_name' => 'Sarah Mills',
                'published_at' => '2026-03-25 10:00:00',
                'meta_keywords' => 'editorial links, backlinks, seo',
                'show_on_blog' => true,
                'is_trending' => false,
                'content' => <<<'HTML'
<h2>What Are Editorial Links?</h2>
<p>Editorial links are links placed naturally inside useful content. They work best when the mention supports the article and helps readers learn more about a relevant topic.</p>
<h2>How To Build Them</h2>
<p>Start with strong target pages, useful content assets, and publishers that already cover your topic. The pitch should explain why the placement improves the article for readers.</p>
<h2>Why Quality Matters</h2>
<p>Search engines reward links that make editorial sense. That is why Creavibe focuses on relevant publishers and transparent placement details.</p>
HTML,
            ],
            [
                'category' => Article::CATEGORY_LINK_BUILDING,
                'title' => 'Loganix Alternative: A Modern Link Building Option',
                'slug' => 'loganix-alternative',
                'excerpt' => 'A focused SEO landing article for people comparing Loganix alternatives and looking for a modern link building workflow.',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1600&q=80',
                'image_title' => 'Modern link building platform workflow',
                'image_alt_text' => 'Team planning a modern link building platform workflow',
                'image_description' => 'A collaborative planning image used for a Creavibe article comparing Loganix alternatives and modern link building workflows.',
                'image_caption' => 'Modern link building workflows need publisher choice, clarity, and repeatable execution.',
                'author_name' => 'Safdar Ali',
                'published_at' => '2026-04-12 10:00:00',
                'meta_keywords' => 'loganix alternative, link building platform, guest posting',
                'show_on_blog' => false,
                'is_trending' => false,
                'content' => <<<'HTML'
<h2>Why Look For A Loganix Alternative?</h2>
<p>SEO teams often compare link building platforms when they need more flexibility, clearer publisher selection, and a workflow that supports modern digital PR campaigns.</p>
<h2>What Makes Creavibe Different?</h2>
<p>Creavibe focuses on helping advertisers connect with publishers for content placements, guest posts, and authority backlinks. The platform is built around campaign clarity, publisher choice, and practical order management.</p>
<h2>Who Should Use This Type Of Platform?</h2>
<p>Creavibe is useful for agencies, brands, and SEO teams that want to plan link campaigns around relevance, quality, and repeatable publishing workflows.</p>
<h2>Final Thoughts</h2>
<p>If you are researching Loganix alternatives, compare publisher quality, communication, payment options, and placement transparency before choosing a platform.</p>
HTML,
            ],
        ];

        Article::where('is_trending', true)->update(['is_trending' => false]);

        foreach ($articles as $article) {
            $authorName = $article['author_name'];
            $categoryName = $article['category'];

            Article::updateOrCreate(
                ['slug' => $article['slug']],
                array_merge($article, [
                    'author_id' => $authorIds[$authorName] ?? null,
                    'blog_category_id' => $categoryIds[$categoryName] ?? null,
                    'status' => 'Published',
                    'meta_title' => $article['title'] . ' | Creavibe',
                    'meta_description' => $article['excerpt'],
                    'view_count' => 0,
                ])
            );
        }
    }
}
