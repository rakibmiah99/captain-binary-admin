<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CodePadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PerformanceController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\SolvedController;
use App\Http\Controllers\LeaderBoardController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\SessionAuthenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [Web\AdminController::class, 'login'])->name('login');
Route::get('/', [Web\AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/contacts', [Web\AdminController::class, 'contacts'])->name('contacts');
Route::get('/testimonials', [Web\AdminController::class, 'testimonials'])->name('testimonials');
Route::get('/category', [Web\AdminController::class, 'category'])->name('category');
Route::get('/problems', [Web\AdminController::class, 'problems'])->name('problems');
Route::get('/users', [Web\AdminController::class, 'users'])->name('users');
