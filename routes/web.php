<?php

use App\Http\Controllers\Admin\ClientWorkController;
use App\Http\Controllers\Admin\DashboardManage;
use App\Http\Controllers\Admin\FeaturedProjectController;
use App\Http\Controllers\Admin\SaasProductController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\SaasProductPageController;
use App\Http\Controllers\Visotors\VisitorController;
use App\Http\Middleware\VisitorCounter;
use App\Models\ClientWork;
use App\Models\FeaturedProject;
use App\Models\SaasProduct;
use App\Models\Skill;
use App\Models\TeamMember;
use App\Models\Visitor;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// I want to get the all visitor details from db i want to make a in csv file and download it
Route::get('/export-visitors', function () {

    $visitors = Visitor::all();

    $csvData = "id,ip,user_agent,referrer,country,city,status,created_at,updated_at\n";

    foreach ($visitors as $visitor) {

        $createdAt = optional($visitor->created_at)->format('Y-m-d H:i:s');
        $updatedAt = optional($visitor->updated_at)->format('Y-m-d H:i:s');

        $csvData .= "{$visitor->id},"
            ."\"{$visitor->ip}\","
            ."\"{$visitor->user_agent}\","
            ."\"{$visitor->referrer}\","
            ."\"{$visitor->country}\","
            ."\"{$visitor->city}\","
            ."\"{$visitor->status}\","
            ."\"{$createdAt}\","
            ."\"{$updatedAt}\"\n";
    }

    return response($csvData)
        ->header('Content-Type', 'text/csv')
        ->header('Content-Disposition', 'attachment; filename=\"visitors.csv\"');
});

Route::get('/server-migrate', function () {

    Artisan::call('migrate', [
        '--force' => true,
    ]);

    Artisan::call('db:seed', [
        '--force' => true,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Database migrations and seeders executed successfully.',
        'migration_output' => Artisan::output(),
    ]);

})->name('server.migrate');

Route::get('/', function () {
    $skills = Skill::active()
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get();

    $featuredProjects = FeaturedProject::active()
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get();

    $saasProducts = SaasProduct::active()
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get();

    $clientWorks = ClientWork::active()
        ->orderBy('sort_order')
        ->orderBy('title')
        ->get();

    $teamMembers = TeamMember::active()
        ->orderBy('sort_order')
        ->orderBy('name')
        ->get();

    return view('frontend.main', compact('skills', 'featuredProjects', 'saasProducts', 'clientWorks', 'teamMembers'));
})
    ->middleware(VisitorCounter::class)
    ->name('home');

Route::get('/projects/{slug}', [SaasProductPageController::class, 'show'])
    ->name('projects.show');

Route::post('/contact', [ContactusController::class, 'create'])
    ->name('contact.submit');

// Admin dashboard route
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardManage::class, 'dashboard'])->name('dashboard');
    Route::view('admin-profile', 'admin.profile.admin-profile')->name('admin.profile');

    // Admin Dashboard Routes
    Route::get('/notifications', [ContactusController::class, 'notifications']);
    Route::any('/message/{id}/mark-read', [ContactusController::class, 'markAsRead']);

    // Contact Us Messages
    Route::get('contact-messages', [ContactusController::class, 'index'])->name('contactus.index');
    Route::delete('contact-messages/{id}', [ContactusController::class, 'destroy'])->name('contactus.destroy');

    // Delete message
    Route::delete('messages/delete', [ContactusController::class, 'destroy'])->name('messages.delete');

    // Visitor Stats
    Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::delete('visitor/delete', [VisitorController::class, 'destroy'])->name('visitor.delete');
    Route::patch('visitor/toggle-status', [VisitorController::class, 'toggleStatus'])->name('visitor.toggleStatus');

    // Team Members
    Route::resource('team-members', TeamMemberController::class)
        ->parameters(['team-members' => 'teamMember'])
        ->except('show');
    Route::patch('team-members/{teamMember}/toggle-status', [TeamMemberController::class, 'toggleStatus'])
        ->name('team-members.toggle-status');

    Route::resource('skills', SkillController::class)->except('show');
    Route::patch('skills/{skill}/toggle-status', [SkillController::class, 'toggleStatus'])
        ->name('skills.toggle-status');

    Route::resource('featured-projects', FeaturedProjectController::class)
        ->parameters(['featured-projects' => 'featuredProject'])
        ->except('show');
    Route::patch('featured-projects/{featuredProject}/toggle-status', [FeaturedProjectController::class, 'toggleStatus'])
        ->name('featured-projects.toggle-status');

    Route::resource('saas-products', SaasProductController::class)
        ->parameters(['saas-products' => 'saasProduct'])
        ->except('show');
    Route::patch('saas-products/{saasProduct}/toggle-status', [SaasProductController::class, 'toggleStatus'])
        ->name('saas-products.toggle-status');

    Route::resource('client-work', ClientWorkController::class)
        ->parameters(['client-work' => 'clientWork'])
        ->except('show');
    Route::patch('client-work/{clientWork}/toggle-status', [ClientWorkController::class, 'toggleStatus'])
        ->name('client-work.toggle-status');

    Route::post('profile-update', [AuthController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Authentication routes
Route::middleware(['guest'])->group(function () {
    Route::view('admin/login', 'admin.auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.perform');
});
