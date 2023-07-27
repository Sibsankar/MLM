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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-registration', [App\Http\Controllers\UserRegistrationController::class, 'registration'])->name('registration');
Route::post('/get-sponser-details', [App\Http\Controllers\UserRegistrationController::class, 'getSponser'])->name('getSponser');

Route::post('/add-user', [App\Http\Controllers\UserRegistrationController::class, 'addUser'])->name('addUser');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/change-pwd', [App\Http\Controllers\HomeController::class, 'changePwd'])->name('updatePwd');
