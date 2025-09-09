<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VisitorCounter;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\Admin\DashboardManage;
use App\Http\Controllers\Visotors\VisitorController;



Route::view('/', 'frontend.main')
    ->middleware(VisitorCounter::class)
    ->name('home');

Route::post('/contact', [ContactusController::class, 'create'])
    ->name('contact.submit');

// Admin dashboard route
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardManage::class, 'dashboard'])->name('dashboard');
    Route::view('admin-profile', 'admin.profile.admin-profile')->name('admin.profile');

    // Admin Dashboard Routes
    Route::get('/notifications', [ContactusController::class, 'notifications']);
    Route::any('/message/{id}/mark-read', [ContactusController::class, 'markAsRead']);

    //Contact Us Messages
    Route::get('contact-messages', [ContactusController::class, 'index'])->name('contactus.index');
    Route::delete('contact-messages/{id}', [ContactusController::class, 'destroy'])->name('contactus.destroy');


    // Delete message
    Route::delete('messages/delete', [ContactusController::class, 'destroy'])->name('messages.delete');

    // Visitor Stats
    Route::get('visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::delete('visitor/delete', [VisitorController::class, 'destroy'])->name('visitor.delete');
    Route::patch('visitor/toggle-status', [VisitorController::class, 'toggleStatus'])->name('visitor.toggleStatus');

    Route::post('profile-update', [AuthController::class, 'profileUpdate'])->name('admin.profile.update');
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// Authentication routes
Route::middleware(['guest'])->group(function () {
    Route::view('admin/login', 'admin.auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.perform');
});
