<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth.check', 'localization'])->prefix('/')->group(function (){
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'page'])->name('home');
    Route::get('/profile', [\App\Http\Controllers\UserController::class, 'profilePage'])->name('profile');
    Route::post('/profile', [\App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/change-password', [\App\Http\Controllers\UserController::class, 'changePasswordPage'])->name('profile.change_password_page');
    Route::post('/profile/change-password', [\App\Http\Controllers\UserController::class, 'changePassword'])->name('profile.change_password');

    Route::prefix('category')->name('category.')->group(function (){
        Route::get('/', [\App\Http\Controllers\CategoryController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('delete');
    });

    Route::prefix('testimonial')->name('testimonial.')->group(function (){
        Route::get('/', [\App\Http\Controllers\TestimonalController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\TestimonalController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\TestimonalController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\TestimonalController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\TestimonalController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\TestimonalController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\TestimonalController::class, 'delete'])->name('delete');
    });

    Route::prefix('contact')->name('contact.')->group(function (){
        Route::get('/', [\App\Http\Controllers\ContactController::class, 'index'])->name('index');
        Route::get('/show/{id}', [\App\Http\Controllers\ContactController::class, 'show'])->name('show');
        Route::get('/changeStatus/{id}', [\App\Http\Controllers\ContactController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/delete/{id}', [\App\Http\Controllers\ContactController::class, 'delete'])->name('delete');
    });


    Route::prefix('problem')->name('problem.')->group(function (){
        Route::get('/', [\App\Http\Controllers\ProblemController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\ProblemController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\ProblemController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\ProblemController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\ProblemController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\ProblemController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\ProblemController::class, 'delete'])->name('delete');
    });


    Route::prefix('company-settings')->name('settings.')->group(function (){
        Route::get('/', [\App\Http\Controllers\CompanySettingsController::class, 'companySettings'])->name('company');
        Route::post('/update', [\App\Http\Controllers\CompanySettingsController::class, 'companySettingsUpdate'])->name('company.update');
    });



    Route::prefix('roles')->name('role.')->group(function (){
        Route::get('/', [\App\Http\Controllers\RolesController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\RolesController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\RolesController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\RolesController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\RolesController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\RolesController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\RolesController::class, 'delete'])->name('delete');
    });


    Route::prefix('users')->name('user.')->group(function (){
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\UserController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\UserController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\UserController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\UserController::class, 'delete'])->name('delete');
   });


    Route::get('change-lang/{lang}', [\App\Http\Controllers\LangController::class, 'change'])->name('lang.change');
    Route::get('change-theme/{name}', [\App\Http\Controllers\LangController::class, 'changeTheme'])->name('theme.change');
});

Route::middleware('localization')->get('/login', [\App\Http\Controllers\AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
