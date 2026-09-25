<?php

use App\Http\Controllers\Admin\ClientWorkController;
use App\Http\Controllers\Admin\DashboardManage;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\FeaturedProjectController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SaasProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectPageController;
use App\Http\Controllers\SaasIndexController;
use App\Http\Controllers\SaasProductPageController;
use App\Http\Controllers\ServicePageController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Visotors\VisitorController;
use App\Http\Middleware\VisitorCounter;
use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════════
// 301 Redirects  Preserve SEO on URL changes
// ═══════════════════════════════════════════════

// Old /blogs/* → /blog/*
Route::redirect('/blogs', '/blog', 301);
Route::get('/blogs/{path}', fn (string $path) => redirect('/blog/' . $path, 301))
    ->where('path', '.*');

// ═══════════════════════════════════════════════
// Sitemap
// ═══════════════════════════════════════════════
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// ═══════════════════════════════════════════════
// Public Frontend  Main pages
// ═══════════════════════════════════════════════
Route::get('/', [HomeController::class, 'index'])
    ->middleware(VisitorCounter::class)
    ->name('home');

Route::get('/about',      [PageController::class, 'about'])->name('about');
Route::get('/skills',     [PageController::class, 'skills'])->name('skills');
Route::get('/experience', [PageController::class, 'experience'])->name('experience');
Route::get('/contact',    [PageController::class, 'contact'])->name('contact');
Route::get('/faqs',       [PageController::class, 'faqs'])->name('faqs');
Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-and-conditions', [PageController::class, 'terms'])->name('terms');

Route::post('/contact', [ContactusController::class, 'create'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

// ═══════════════════════════════════════════════
// SaaS Products
// ═══════════════════════════════════════════════
Route::get('/saas',        [SaasIndexController::class, 'index'])->name('saas.index');
Route::get('/saas/{slug}', [SaasProductPageController::class, 'show'])->name('saas.show');

// ═══════════════════════════════════════════════
// Projects (Case Studies)
// ═══════════════════════════════════════════════
Route::get('/projects',        [ProjectPageController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectPageController::class, 'show'])->name('projects.show');

// ═══════════════════════════════════════════════
// Services
// ═══════════════════════════════════════════════
Route::get('/services',        [ServicePageController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServicePageController::class, 'show'])->name('services.show');

// ═══════════════════════════════════════════════
// Admin Panel (auth protected)
// ═══════════════════════════════════════════════
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardManage::class, 'dashboard'])->name('dashboard');
    Route::view('admin-profile', 'admin.profile.admin-profile')->name('profile');

    // Notifications & messages
    Route::get('/notifications', [ContactusController::class, 'notifications']);
    Route::patch('/message/{id}/mark-read', [ContactusController::class, 'markAsRead']);
    Route::get('contact-messages', [ContactusController::class, 'index'])->name('contactus.index');
    Route::delete('contact-messages/{id}', [ContactusController::class, 'destroy'])->name('contactus.destroy');
    Route::delete('messages/delete', [ContactusController::class, 'destroy'])->name('messages.delete');

    // Visitors
    Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::delete('visitor/delete', [VisitorController::class, 'destroy'])->name('visitor.delete');
    Route::patch('visitor/toggle-status', [VisitorController::class, 'toggleStatus'])->name('visitor.toggleStatus');

    // Skills
    Route::resource('skills', SkillController::class)->except('show');
    Route::patch('skills/{skill}/toggle-status', [SkillController::class, 'toggleStatus'])
        ->name('skills.toggle-status');

    // Team Members
    Route::resource('team-members', TeamMemberController::class)
        ->parameters(['team-members' => 'teamMember'])
        ->except('show');
    Route::patch('team-members/{teamMember}/toggle-status', [TeamMemberController::class, 'toggleStatus'])
        ->name('team-members.toggle-status');

    // Featured Projects (homepage cards  legacy)
    Route::resource('featured-projects', FeaturedProjectController::class)
        ->parameters(['featured-projects' => 'featuredProject'])
        ->except('show');
    Route::patch('featured-projects/{featuredProject}/toggle-status', [FeaturedProjectController::class, 'toggleStatus'])
        ->name('featured-projects.toggle-status');

    // Projects (case studies)
    Route::resource('projects', ProjectController::class)->except('show');
    Route::patch('projects/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])
        ->name('projects.toggle-status');

    // SaaS Products
    Route::resource('saas-products', SaasProductController::class)
        ->parameters(['saas-products' => 'saasProduct'])
        ->except('show');
    Route::patch('saas-products/{saasProduct}/toggle-status', [SaasProductController::class, 'toggleStatus'])
        ->name('saas-products.toggle-status');

    // Services
    Route::resource('services', ServiceController::class)->except('show');
    Route::patch('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])
        ->name('services.toggle-status');

    // Client Work
    Route::resource('client-work', ClientWorkController::class)
        ->parameters(['client-work' => 'clientWork'])
        ->except('show');
    Route::patch('client-work/{clientWork}/toggle-status', [ClientWorkController::class, 'toggleStatus'])
        ->name('client-work.toggle-status');

    // Experience
    Route::resource('experiences', ExperienceController::class)->except('show');
    Route::patch('experiences/{experience}/toggle-status', [ExperienceController::class, 'toggleStatus'])
        ->name('experiences.toggle-status');

    // Testimonials
    Route::resource('testimonials', TestimonialController::class)->except('show');
    Route::patch('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])
        ->name('testimonials.toggle-status');

    // Profile & auth
    Route::post('profile-update', [AuthController::class, 'profileUpdate'])->name('profile.update');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// ═══════════════════════════════════════════════
// Auth
// ═══════════════════════════════════════════════
Route::middleware(['guest'])->group(function () {
    Route::view('admin/login', 'admin.auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.perform');
});
