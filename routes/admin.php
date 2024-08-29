<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::middleware(['auth:sanctum', 'auth:admin'])->group(function (){
    Route::get('/', [Admin\DashboardController::class, 'page']);
    Route::get('/profile', [Admin\UserController::class, 'profilePage']);
    Route::post('/profile', [Admin\UserController::class, 'updateProfile']);
    Route::post('/profile/change-password', [Admin\UserController::class, 'changePassword']);

    Route::prefix('category')->group(function (){
        Route::get('/', [Admin\CategoryController::class, 'index']);
        Route::get('/all', [Admin\CategoryController::class, 'allCategory']);
        Route::get('/show/{id}', [Admin\CategoryController::class, 'show']);
        Route::post('/update/{id}', [Admin\CategoryController::class, 'update']);
        Route::post('/store', [Admin\CategoryController::class, 'store']);
        Route::post('/delete/{id}', [Admin\CategoryController::class, 'delete']);
    });

    Route::prefix('testimonial')->group(function (){
        Route::get('/', [Admin\TestimonalController::class, 'index']);
        Route::get('/show/{id}', [Admin\TestimonalController::class, 'show']);
        Route::post('/update/{id}', [Admin\TestimonalController::class, 'update']);
        Route::post('/store', [Admin\TestimonalController::class, 'store']);
        Route::post('/delete/{id}', [Admin\TestimonalController::class, 'delete']);
    });

    Route::prefix('contact')->group(function (){
        Route::get('/', [Admin\ContactController::class, 'index']);
        Route::get('/show/{id}', [Admin\ContactController::class, 'show']);
        Route::get('/changeStatus/{id}', [Admin\ContactController::class, 'changeStatus']);
        Route::post('/delete/{id}', [Admin\ContactController::class, 'delete']);
    });


    Route::prefix('problem')->group(function (){
        Route::get('/', [Admin\ProblemController::class, 'index']);
        Route::get('/show/{id}', [Admin\ProblemController::class, 'show']);
        Route::post('/update/{id}', [Admin\ProblemController::class, 'update']);
        Route::post('/store', [Admin\ProblemController::class, 'store']);
        Route::post('/delete/{id}', [Admin\ProblemController::class, 'delete']);
    });



    Route::prefix('users')->group(function (){
        Route::get('/', [Admin\UserController::class, 'index']);
        Route::get('/show/{id}', [Admin\UserController::class, 'show']);
        Route::post('/update/{id}', [Admin\UserController::class, 'update']);
        Route::post('/store', [Admin\UserController::class, 'store']);
        Route::post('/delete/{id}', [Admin\UserController::class, 'delete']);
    });

});

Route::post('/login', [Admin\AuthController::class, 'login']);
