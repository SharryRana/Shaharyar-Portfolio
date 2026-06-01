<?php

use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Modules\Blog\Http\Controllers\Admin\ArticleController;
use Modules\Blog\Http\Controllers\Admin\AuthController;
use Modules\Blog\Http\Controllers\Admin\AuthorController;
use Modules\Blog\Http\Controllers\Admin\BlogCategoryController;
use Modules\Blog\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use Modules\Blog\Http\Controllers\Admin\DescriptionController;
use Modules\Blog\Http\Controllers\Admin\FaqController;
use Modules\Blog\Http\Controllers\Admin\PageController;
use Modules\Blog\Http\Controllers\Admin\ProfileController;
use Modules\Blog\Http\Controllers\Admin\SettingController;
use Modules\Blog\Http\Controllers\Admin\ArticleCommentController as AdminArticleCommentController;
use Modules\Blog\Http\Controllers\Admin\NewsletterSubscriberController as AdminNewsletterSubscriberController;
use Modules\Blog\Http\Controllers\ArticleInteractionController;
use Modules\Blog\Http\Controllers\ContactMessageController;
use Modules\Blog\Http\Controllers\NewsletterSubscriberController;
use Modules\Blog\Http\Middleware\BlogAdminAuth;
use Modules\Blog\Models\ActivityLog;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\ArticleView;
use Modules\Blog\Models\BlogCategory as BlogCategoryModel;
use Modules\Blog\Models\ContactMessage;
use Modules\Blog\Models\Description;
use Modules\Blog\Models\Faq;
use Modules\Blog\Models\Page;
use Modules\Blog\Models\Visit;

$blogIndexData = function (?BlogCategoryModel $selectedCategory = null): array {
    $publishedArticles = Article::with(['author', 'blogCategory'])
        ->where('status', 'Published')
        ->whereNotNull('published_at')
        ->where('show_on_blog', true)
        ->when($selectedCategory, fn ($query) => $query->where('blog_category_id', $selectedCategory->id))
        ->latest('published_at');

    return [
        'articles' => $publishedArticles->paginate(6)->withQueryString(),
        'categories' => BlogCategoryModel::query()
            ->where('is_active', true)
            ->withCount(['articles' => fn ($query) => $query->where('status', 'Published')->whereNotNull('published_at')->where('show_on_blog', true)])
            ->orderBy('name')
            ->get(),
        'popularPosts' => Article::with(['author', 'blogCategory'])
            ->where('status', 'Published')
            ->whereNotNull('published_at')
            ->where('show_on_blog', true)
            ->orderByDesc('view_count')
            ->latest('published_at')
            ->take(3)
            ->get(),
        'selectedCategory' => $selectedCategory,
    ];
};

$clientIp = function (Request $request): ?string {
    foreach (['CF-Connecting-IP', 'True-Client-IP', 'X-Real-IP'] as $header) {
        $ip = $request->headers->get($header);

        if ($ip && filter_var($ip, FILTER_VALIDATE_IP)) {
            return $ip;
        }
    }

    $forwardedFor = $request->headers->get('X-Forwarded-For');

    if ($forwardedFor) {
        foreach (explode(',', $forwardedFor) as $ip) {
            $ip = trim($ip);

            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }

    return $request->ip();
};

$visitorKey = function (Request $request) use ($clientIp): string {
    $sessionId = $request->hasSession() ? $request->session()->getId() : null;

    return hash('sha256', ($sessionId ?: 'no-session').'|'.($clientIp($request) ?: 'unknown').'|'.($request->userAgent() ?: 'unknown'));
};

$trackArticleView = function (Article $article, Request $request) use ($clientIp, $visitorKey): void {
    if (Schema::hasTable('article_views')) {
        try {
            $view = ArticleView::firstOrCreate(
                [
                    'article_id' => $article->id,
                    'visitor_key' => $visitorKey($request),
                ],
                [
                    'ip_address' => $clientIp($request),
                    'user_agent' => $request->userAgent(),
                ]
            );
        } catch (\Illuminate\Database\QueryException) {
            return;
        }

        if ($view->wasRecentlyCreated) {
            $article->incrementViews();
        }

        return;
    }

    $sessionKey = 'blog_article_viewed_'.$article->id;

    if (! $request->session()->has($sessionKey)) {
        $article->incrementViews();
        $request->session()->put($sessionKey, true);
    }
};

$showPublishedArticle = function (Request $request, string $slug) use ($trackArticleView) {
    $article = Article::with(['author', 'blogCategory'])
        ->where('slug', $slug)
        ->where('status', 'Published')
        ->whereNotNull('published_at')
        ->firstOrFail();

    $trackArticleView($article, $request);

    $hasCommentTables = Schema::hasTable('article_comments') && Schema::hasTable('article_comment_reactions');
    $hasHelpfulTable = Schema::hasTable('article_helpful_votes');

    $approvedComments = $hasCommentTables
        ? $article->approvedComments()
            ->withCount([
                'reactions as likes_count' => fn ($query) => $query->where('reaction', 'like'),
                'reactions as dislikes_count' => fn ($query) => $query->where('reaction', 'dislike'),
            ])
            ->latest()
            ->paginate(5)
        : collect();

    $helpfulCounts = $hasHelpfulTable
        ? $article->helpfulVotes()
            ->selectRaw('vote, COUNT(*) as total')
            ->groupBy('vote')
            ->pluck('total', 'vote')
        : collect();

    return view('blog::blog.show', [
        'article' => $article,
        'approvedComments' => $approvedComments,
        'commentsEnabled' => $hasCommentTables,
        'helpfulEnabled' => $hasHelpfulTable,
        'helpfulCounts' => [
            'yes' => (int) ($helpfulCounts['yes'] ?? 0),
            'no' => (int) ($helpfulCounts['no'] ?? 0),
        ],
        'categories' => BlogCategoryModel::query()
            ->where('is_active', true)
            ->withCount(['articles' => fn ($query) => $query->where('status', 'Published')->whereNotNull('published_at')->where('show_on_blog', true)])
            ->orderBy('name')
            ->get(),
        'popularPosts' => Article::with(['author', 'blogCategory'])
            ->where('status', 'Published')
            ->whereNotNull('published_at')
            ->where('show_on_blog', true)
            ->where('id', '!=', $article->id)
            ->orderByDesc('view_count')
            ->latest('published_at')
            ->take(3)
            ->get(),
        'relatedPosts' => Article::with(['author', 'blogCategory'])
            ->where('status', 'Published')
            ->whereNotNull('published_at')
            ->where('show_on_blog', true)
            ->where('id', '!=', $article->id)
            ->when($article->blog_category_id, fn ($query) => $query->where('blog_category_id', $article->blog_category_id))
            ->latest('published_at')
            ->take(3)
            ->get(),
    ]);
};

Route::get('/blog', fn () => view('blog::index', $blogIndexData()))->name('blog.index');

Route::prefix('blogs')->group(function () use ($blogIndexData) {
    Route::get('/', fn () => view('blog::index', $blogIndexData()))->name('blogs.index');
    Route::get('blogs-category', fn () => view('blog::Category.category', [
        'categories' => BlogCategoryModel::query()
            ->where('is_active', true)
            ->withCount(['articles' => fn ($query) => $query->where('status', 'Published')->whereNotNull('published_at')->where('show_on_blog', true)])
            ->orderBy('name')
            ->get(),
    ]))->name('blog.category');
    Route::get('category/{category:slug}', fn (BlogCategoryModel $category) => view('blog::index', $blogIndexData($category)))
        ->name('blog.category.show');
    Route::view('feature', 'blog::Features.feature')->name('blog.feature');
    Route::get('about-us', fn () => view('blog::About.about', [
        'teamMembers' => TeamMember::active()->orderBy('sort_order')->get(),
    ]))->name('blog.about');
    Route::get('contact-us', fn () => view('blog::Contactus.contactus', [
        'categories' => BlogCategoryModel::query()
            ->where('is_active', true)
            ->withCount(['articles' => fn ($query) => $query->where('status', 'Published')->whereNotNull('published_at')->where('show_on_blog', true)])
            ->orderBy('name')
            ->get(),
        'popularPosts' => Article::with(['author', 'blogCategory'])
            ->where('status', 'Published')
            ->whereNotNull('published_at')
            ->where('show_on_blog', true)
            ->orderByDesc('view_count')
            ->latest('published_at')
            ->take(3)
            ->get(),
    ]))->name('blog.contactus');
    Route::post('contact-us', [ContactMessageController::class, 'store'])->name('blog.contact-us.submit');
    Route::post('newsletter', [NewsletterSubscriberController::class, 'store'])->middleware('throttle:5,1')->name('blog.newsletter.submit');
    Route::get('articles/{article}/comments', [ArticleInteractionController::class, 'listComments'])->name('blog.comments.index');
    Route::post('articles/{article}/comments', [ArticleInteractionController::class, 'storeComment'])->middleware('throttle:5,1')->name('blog.comments.store');
    Route::post('comments/{comment}/reaction', [ArticleInteractionController::class, 'reactToComment'])->middleware('throttle:20,1')->name('blog.comments.react');
    Route::post('articles/{article}/helpful', [ArticleInteractionController::class, 'helpfulVote'])->middleware('throttle:10,1')->name('blog.articles.helpful');
});

Route::prefix('blog-admin')->name('blog-admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(BlogAdminAuth::class)->group(function () {
        Route::get('/', function () {
            $stats = getVisitsStats();

            return view('blog::admin.dashboard', [
                'articlesCount' => Article::count(),
                'usersCount' => User::count('id'),
                'faqsCount' => Faq::count(),
                'descriptionsCount' => Description::count(),
                'pagesCount' => Page::count(),
                'messagesCount' => ContactMessage::count(),
                'recentMessages' => ContactMessage::latest()->take(5)->get(),
                'recentActivities' => ActivityLog::with('user')->latest()->take(10)->get(),
                'totalVisits' => $stats['total_visits'],
                'todayVisits' => $stats['today_visits'],
                'thisWeekVisits' => $stats['this_week_visits'],
                'thisMonthVisits' => $stats['this_month_visits'],
                'articleVisits' => $stats['article_visits'],
                'uniqueVisitors' => $stats['unique_visitors'],
                'mobileVisits' => $stats['mobile_visits'],
                'desktopVisits' => $stats['desktop_visits'],
                'tabletVisits' => $stats['tablet_visits'],
                'recentVisits' => Visit::with('article')->latest()->take(10)->get(),
                'mostViewedArticles' => getMostViewedArticles(5),
            ]);
        })->name('dashboard');

        Route::get('/analytics', function () {
            $stats = getVisitsStats();

            return view('blog::admin.analytics', [
                'stats' => $stats,
                'topArticles' => getMostViewedArticles(10),
                'recentVisits' => Visit::with('article')->latest()->paginate(15, ['*'], 'visits_page')->withQueryString(),
            ]);
        })->name('analytics');

        Route::get('/traffic', function (Request $request) {
            $filters = $request->validate([
                'search' => ['nullable', 'string', 'max:255'],
                'method' => ['nullable', 'string', 'in:GET,POST,PUT,PATCH,DELETE'],
                'device_type' => ['nullable', 'string', 'max:50'],
            ]);

            $visits = Visit::query()
                ->when($filters['search'] ?? null, function ($query, string $search) {
                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('ip_address', 'like', '%'.$search.'%')
                            ->orWhere('url', 'like', '%'.$search.'%')
                            ->orWhere('country', 'like', '%'.$search.'%')
                            ->orWhere('region', 'like', '%'.$search.'%')
                            ->orWhere('city', 'like', '%'.$search.'%')
                            ->orWhere('user_agent', 'like', '%'.$search.'%');
                    });
                })
                ->when($filters['method'] ?? null, fn ($query, string $method) => $query->where('method', $method))
                ->when($filters['device_type'] ?? null, fn ($query, string $deviceType) => $query->where('device_type', $deviceType))
                ->latest()
                ->paginate(10)
                ->withQueryString();

            return view('blog::admin.traffic.index', [
                'visits' => $visits,
                'filters' => $filters,
                'deviceTypes' => Visit::whereNotNull('device_type')->distinct()->orderBy('device_type')->pluck('device_type'),
            ]);
        })->name('traffic.index');

        Route::get('articles/resolve-slug', [ArticleController::class, 'resolveSlug'])->name('articles.resolve-slug');
        Route::post('articles/upload-image', [ArticleController::class, 'uploadImage'])->name('articles.upload');
        Route::resource('articles', ArticleController::class)->except(['show']);
        Route::patch('authors/{author}/toggle-status', [AuthorController::class, 'toggleStatus'])->name('authors.toggle-status');
        Route::resource('authors', AuthorController::class)->except(['show']);
        Route::get('blog-categories/resolve-slug', [BlogCategoryController::class, 'resolveSlug'])->name('blog-categories.resolve-slug');
        Route::patch('blog-categories/{blogCategory}/toggle-status', [BlogCategoryController::class, 'toggleStatus'])->name('blog-categories.toggle-status');
        Route::resource('blog-categories', BlogCategoryController::class)
            ->parameters(['blog-categories' => 'blogCategory'])
            ->except(['show']);
        Route::resource('faqs', FaqController::class);
        Route::resource('descriptions', DescriptionController::class);
        Route::resource('pages', PageController::class)->only(['index', 'edit', 'update']);
        Route::get('/users', function (Request $request) {
            $filters = $request->validate([
                'search' => ['nullable', 'string', 'max:255'],
                'role' => ['nullable', 'string', 'in:admin,user'],
            ]);

            $users = User::query()
                ->when($filters['search'] ?? null, function ($query, string $search) {
                    $query->where(function ($query) use ($search) {
                        $query
                            ->where('name', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%');
                    });
                })
                ->when($filters['role'] ?? null, fn ($query, string $role) => $query->where('role', $role))
                ->latest()
                ->paginate(15)
                ->withQueryString();

            return view('blog::admin.users.index', [
                'users' => $users,
                'filters' => $filters,
            ]);
        })->name('users.index');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/messages', [AdminContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [AdminContactMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{id}', [AdminContactMessageController::class, 'destroy'])->name('messages.destroy');
        Route::get('/newsletter-subscribers', [AdminNewsletterSubscriberController::class, 'index'])->name('newsletter.index');
        Route::patch('/newsletter-subscribers/{subscriber}/toggle-status', [AdminNewsletterSubscriberController::class, 'toggleStatus'])->name('newsletter.toggle-status');
        Route::delete('/newsletter-subscribers/{subscriber}', [AdminNewsletterSubscriberController::class, 'destroy'])->name('newsletter.destroy');
        Route::get('/comments', [AdminArticleCommentController::class, 'index'])->name('comments.index');
        Route::patch('/comments/{comment}/approve', [AdminArticleCommentController::class, 'approve'])->name('comments.approve');
        Route::patch('/comments/{comment}/reject', [AdminArticleCommentController::class, 'reject'])->name('comments.reject');
        Route::delete('/comments/{comment}', [AdminArticleCommentController::class, 'destroy'])->name('comments.destroy');
    });
});

Route::get('/blog/{slug}', fn (string $slug) => redirect()->route('blog.show', $slug, 301))
    ->name('blog.show.legacy');

Route::get('/blog-page/{slug}', function (Request $request, string $slug) use ($trackArticleView) {
    $article = Article::with(['author', 'blogCategory'])
        ->where('slug', $slug)
        ->where('status', 'Published')
        ->whereNotNull('published_at')
        ->where('show_on_blog', false)
        ->firstOrFail();

    $trackArticleView($article, $request);

    return view('blog::blog.show', ['article' => $article]);
})->name('blog.articles.seo.show');

Route::get('/{slug}', $showPublishedArticle)
    ->where('slug', '^(?!admin$|admin/|api$|api/|blog$|blogs$|blogs/|blog-admin$|blog-admin/|blog-page$|blog-page/|projects$|projects/|contact$|login$|server-migrate$)[A-Za-z0-9-]+$')
    ->name('blog.show');
