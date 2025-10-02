<?php

use Illuminate\Support\Facades\Route;
use Modules\BlogAdmin\Http\Middleware\AuthCheckBlogAdmin;
use Modules\BlogAdmin\Http\Controllers\BlogAdminController;
use Modules\BlogAdmin\Http\Controllers\BlogCategoryController;
use Inertia\Inertia;
use Modules\BlogAdmin\Http\Middleware\InertiaRootSwitch;
use Modules\BlogAdmin\Http\Controllers\Auth\AuthController;




Route::group(['prefix' => 'admin', 'middleware' => [InertiaRootSwitch::class]], function () {
    Route::get('blog-dashboard', [BlogAdminController::class, 'index'])->name('blogadmin.dashboard');
});


Route::get('blog-login', [AuthController::class, 'login'])->name('blogadmin.login')->middleware([InertiaRootSwitch::class]);
