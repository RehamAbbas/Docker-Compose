<?php

use App\Http\Controllers\Dashboard\ContentController;
use App\Http\Controllers\Dashboard\CountryController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\SessionsController;
use App\Http\Controllers\Dashboard\SpecializationController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\GoogleLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes: "web" middleware group
|--------------------------------------------------------------------------
*/

Route::get('google', function () {
    return view('googleAuth');
});

Route::get('auth/google', [GoogleLoginController::class, 'redirectToGoogle']);

Route::get('auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
