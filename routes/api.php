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


Route::post('/login',[UsersController::class,'LoginRequest']);
Route::get('/sign-up',[UsersController::class,'SignUpPage'])->name('sign-up');
Route::get('/forgot-password',[UsersController::class,'ForgotPasswordPage'])->name('forgot-password');
Route::get('/otp-verification',[UsersController::class,'OTPVerificationPage'])->name('otp-verification');
Route::get('/set-password',[UsersController::class,'SetPasswordPage'])->name('set-password');
Route::get('/',[HomeController::class,'HomePage'])->name('home');
Route::get('/profile',[UsersController::class,'ProfilePage'])->middleware(SessionAuthenticate::class)->name('profile');
Route::get('/bookmark',[BookmarkController::class,'BookmarkPage'])->middleware(SessionAuthenticate::class)->name('bookmark');
Route::get('/performance',[PerformanceController::class,'PerformancePage'])->middleware(SessionAuthenticate::class)->name('performance');
Route::get('/problem',[ProblemController::class,'ProblemPage'])->middleware(SessionAuthenticate::class)->name('problem');
Route::get('/solved',[SolvedController::class,'SolvedPage'])->middleware(SessionAuthenticate::class)->name('solved');
Route::get('/code-pad/{problem_id}',[CodePadController::class,'CodePadPage'])->middleware(SessionAuthenticate::class)->name('code-pad');
Route::get('/problem-list/{category_id}',[ProblemController::class,'ProblemListPage'])->middleware(SessionAuthenticate::class)->name('problem-list');


// Post Back Request
Route::post('/contact-request',[HomeController::class,'ContactRequest']);
Route::post('/login-request',[UsersController::class,'LoginRequest']);
Route::post('/registration-request',[UsersController::class,'SignUpRequest']);
Route::post('/otp-request',[UsersController::class,'OTPRequest'])->name('otp-request');
Route::post('/otp-verify-request',[UsersController::class,'OTPVerificationRequest'])->name('otp-verify-request');
Route::post('/set-password-request',[UsersController::class,'SetNewPasswordRequest'])->name('set-password-request');
Route::post('/profile-update-request',[UsersController::class,'ProfileUpdateRequest'])->name('profile-update-request');
Route::get('/logout-request',[UsersController::class,'LogoutRequest'])->name('logout-request');



//Code Test
Route::post('/testCode-padResult',[CodePadController::class,'TestCodePadResult'])->middleware(SessionAuthenticate::class)->name('testCode-padResult');
Route::post('/submitCode-padResult',[CodePadController::class,'SubmitCodePadResult'])->middleware(SessionAuthenticate::class)->name('submitCode-padResult');




// BOOKMARK
Route::post('/add-bookmark-request',[BookmarkController::class,'AddBookmarkRequest'])->middleware(SessionAuthenticate::class)->name('add-bookmark-request');
Route::post('/remove-bookmark-request',[BookmarkController::class,'RemoveBookmarkRequest'])->middleware(SessionAuthenticate::class)->name('remove-bookmark-request');
Route::post('/remove-solved-request',[SolvedController::class,'RemoveSolvedRequest'])->name('remove-solved-request');



//TOP CAPTAIN
Route::get('/leaderBoard',[LeaderBoardController::class,'leaderBoard'])->name('top-captain');
