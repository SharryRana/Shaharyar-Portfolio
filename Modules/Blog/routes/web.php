<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Http\Controllers\BlogCategoryController;

Route::middleware(['auth', 'verified'])->group(function () {});




Route::group(['prefix' => 'blogs'], function () {

    Route::view('/', 'blog::index')->name('blog.index');

    Route::get('blogs-category', [BlogCategoryController::class, 'index'])->name('blog.category');

    Route::view('feature', 'blog::Features.feature')->name('blog.feature');
    Route::view('about-us', 'blog::About.about')->name('blog.about');
    Route::view('contact-us', 'blog::Contactus.contactus')->name('blog.contactus');
});


Route::view('admin-dash', 'blog::admin.dashboard');

Route::get('admin/blog/create-category', [BlogCategoryController::class, 'create'])->name('admin.category.index');
Route::post('admin/blog/categories', [BlogCategoryController::class, 'store'])->name('admin.blog.categories.store');
