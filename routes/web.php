<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportExportController;

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

Route::get('/artisan/{cmd}', [App\Http\Controllers\UserRegistrationController::class, 'artisan_cmd'])->name('artisan_cmd');
Route::get('/sendsms', [App\Http\Controllers\UserRegistrationController::class, 'sendSMS'])->name('sendSMS');

//Forgot password
Route::get('/forgot-password', [App\Http\Controllers\UserRegistrationController::class, 'forgot_password'])->name('forgot_password');
Route::post('/forgot-password/send-otp', [App\Http\Controllers\UserRegistrationController::class, 'send_otp'])->name('send_otp');
Route::any('/forgot-password/verify-otp/{token?}', [App\Http\Controllers\UserRegistrationController::class, 'verify_otp'])->name('verify_otp');
Route::get('/reset-password/{token}', [App\Http\Controllers\UserRegistrationController::class, 'reset_pwd'])->name('reset_pwd');
Route::post('/update-password', [App\Http\Controllers\UserRegistrationController::class, 'update_pwd'])->name('update_pwd');

// Import export routes
Route::controller(ImportExportController::class)->group(function(){
    Route::get('import_users', 'importExport')->name('importUsers');
    Route::post('import', 'import')->name('import');
    // Route::get('export', 'export')->name('export');
});


Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function() {
    Route::get('/commission', [App\Http\Controllers\Admin\CommissionController::class, 'index']);
    Route::get('/rank', [App\Http\Controllers\RankController::class, 'index'])->name('rank');
    Route::get('/addCommissionCategory', [App\Http\Controllers\RankController::class, 'addCommissionCategory'])->name('addCommissionCategory');
    Route::post('/addCategory', [App\Http\Controllers\RankController::class, 'addCategory'])->name('addCategory');

    Route::get('/addCommissionType', [App\Http\Controllers\RankController::class, 'addCommissionType'])->name('addCommissionType');
    Route::post('/addType', [App\Http\Controllers\RankController::class, 'addType'])->name('addType');
    Route::get('/get-types/{catid}', [App\Http\Controllers\Admin\RankConfigController::class, 'getCommTypeByCatId'])->name('get_types');
    Route::get('/get-cats', [App\Http\Controllers\Admin\RankConfigController::class, 'getCommcats'])->name('get_cats');

    Route::group(['prefix' => 'rank-config', 'middleware' => ['admin']], function() {
        Route::get('/ranklist', [App\Http\Controllers\Admin\RankConfigController::class, 'rankList'])->name('rank_list');
        Route::get('/add-config/{rankid}/{phaseid}', [App\Http\Controllers\Admin\RankConfigController::class, 'addConfig'])->name('add_config');
        Route::post('/add-rank-config', [App\Http\Controllers\Admin\RankConfigController::class, 'addRankConfig'])->name('add_rank_config');
        
    });
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user-registration', [App\Http\Controllers\UserRegistrationController::class, 'registration'])->name('registration');
Route::post('/get-sponser-details', [App\Http\Controllers\UserRegistrationController::class, 'getSponser'])->name('getSponser');
Route::post('/get-rank-details', [App\Http\Controllers\UserRegistrationController::class, 'getRankbySp'])->name('getRankbySp');

Route::post('/add-user', [App\Http\Controllers\UserRegistrationController::class, 'addUser'])->name('addUser');
Route::post('/update-profile', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
Route::post('/change-pwd', [App\Http\Controllers\HomeController::class, 'changePwd'])->name('updatePwd');
Route::get('/my-associate', [App\Http\Controllers\HomeController::class, 'myassociate'])->name('my-associate');
Route::get('/view-profile/{id}', [App\Http\Controllers\HomeController::class, 'viewProfile'])->name('viewProfile');
Route::post('/get-cities', [App\Http\Controllers\HomeController::class, 'getCities'])->name('getCities');

