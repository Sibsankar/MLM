<?php

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

Route::get('/', function () {
    return view('auth/login');
});

//Forgot password
Route::get('/forgot-password', [App\Http\Controllers\UserRegistrationController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password/send-otp', [App\Http\Controllers\UserRegistrationController::class, 'send_otp'])->name('send_otp');
Route::any('/forgot-password/verify-otp/{token?}', [App\Http\Controllers\UserRegistrationController::class, 'verify_otp'])->name('verify_otp');
Route::get('/reset-password/{token}', [App\Http\Controllers\UserRegistrationController::class, 'reset_pwd'])->name('reset_pwd');
Route::post('/update-password', [App\Http\Controllers\UserRegistrationController::class, 'update_pwd'])->name('update_pwd');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-registration', [App\Http\Controllers\UserRegistrationController::class, 'registration'])->name('registration');
Route::post('/get-sponser-details', [App\Http\Controllers\UserRegistrationController::class, 'getSponser'])->name('getSponser');
Route::post('/get-rank-details', [App\Http\Controllers\UserRegistrationController::class, 'getRankbySp'])->name('getRankbySp');

Route::post('/add-user', [App\Http\Controllers\UserRegistrationController::class, 'addUser'])->name('addUser');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/change-pwd', [App\Http\Controllers\HomeController::class, 'changePwd'])->name('updatePwd');
Route::get('/my-associate', [App\Http\Controllers\HomeController::class, 'myassociate'])->name('my-associate');
