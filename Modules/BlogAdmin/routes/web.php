<?php

use Illuminate\Support\Facades\Route;
use Modules\BlogAdmin\Http\Controllers\BlogAdminController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('blogadmins', BlogAdminController::class)->names('blogadmin');
});
