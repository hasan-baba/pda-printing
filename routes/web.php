<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [App\Http\Controllers\AdminController::class, 'index']);

        // Setting Routes
        Route::get('/setting', [App\Http\Controllers\SettingController::class, 'index']);
        Route::post('/setting/create', [App\Http\Controllers\SettingController::class, 'store']);

        // Trip Routes
        Route::get('/trip', [App\Http\Controllers\TripController::class, 'index']);
        Route::get('/trip/add', [App\Http\Controllers\TripController::class, 'add']);
        Route::post('/trip/create', [App\Http\Controllers\TripController::class, 'store']);
        Route::get('/trip/{id}', [App\Http\Controllers\TripController::class, 'edit']);
        Route::put('/trip/{id}', [App\Http\Controllers\TripController::class, 'update']);
        Route::delete('/trip/{id}', [App\Http\Controllers\TripController::class, 'destroy']);

        // Enquiry Routes
        Route::get('/enquiry', [App\Http\Controllers\EnquiryController::class, 'index']);
        Route::get('/enquiry/{id}', [App\Http\Controllers\EnquiryController::class, 'view']);
        Route::get('/enquiry/download/{id}', [App\Http\Controllers\EnquiryController::class, 'download']);
        Route::get('/enquiry/download-1/{id}', [App\Http\Controllers\EnquiryController::class, 'downloadTotal1']);
        Route::get('/enquiry/download-2/{id}', [App\Http\Controllers\EnquiryController::class, 'downloadTotal2']);
        Route::post('/enquiry/create', [App\Http\Controllers\EnquiryController::class, 'store']);
        Route::post('/enquiry/update_status', [App\Http\Controllers\EnquiryController::class, 'update_status']);
        Route::post('/enquiry/update_currency', [App\Http\Controllers\EnquiryController::class, 'update_currency']);
        Route::post('/enquiry/update_bank', [App\Http\Controllers\EnquiryController::class, 'update_bank']);
        Route::get('/report', [App\Http\Controllers\EnquiryController::class, 'report']);

        // Lebanese Enquiry Routes
        Route::get('/lb-enquiry', [App\Http\Controllers\LebaneseEnquiryController::class, 'index']);
        Route::get('/lb-enquiry/{id}', [App\Http\Controllers\LebaneseEnquiryController::class, 'view']);
        Route::get('/lb-enquiry/download/{id}', [App\Http\Controllers\LebaneseEnquiryController::class, 'download']);
        Route::get('/lb-enquiry/download-1/{id}', [App\Http\Controllers\LebaneseEnquiryController::class, 'downloadTotal1']);
        Route::get('/lb-enquiry/download-2/{id}', [App\Http\Controllers\LebaneseEnquiryController::class, 'downloadTotal2']);
        Route::post('/lb-enquiry/create', [App\Http\Controllers\LebaneseEnquiryController::class, 'store']);
        Route::post('/lb-enquiry/update_status', [App\Http\Controllers\LebaneseEnquiryController::class, 'update_status']);
        Route::post('/lb-enquiry/update_currency', [App\Http\Controllers\LebaneseEnquiryController::class, 'update_currency']);
        Route::post('/lb-enquiry/update_bank', [App\Http\Controllers\LebaneseEnquiryController::class, 'update_bank']);
        Route::get('/lb-report', [App\Http\Controllers\LebaneseEnquiryController::class, 'report']);

        // Bank Routes
        Route::post('/bank/create', [App\Http\Controllers\BankController::class, 'store']);
        Route::get('/bank/{id}', [App\Http\Controllers\BankController::class, 'edit']);
        Route::put('/bank/{id}', [App\Http\Controllers\BankController::class, 'update']);
        Route::delete('/bank/{id}', [App\Http\Controllers\BankController::class, 'destroy']);

        // User Routes
        Route::get('/user', [App\Http\Controllers\AdminController::class, 'list']);
        Route::post('/user/create', [App\Http\Controllers\AdminController::class, 'store']);
        Route::get('/user/{id}', [App\Http\Controllers\AdminController::class, 'edit']);
        Route::put('/user/{id}', [App\Http\Controllers\AdminController::class, 'update']);
        Route::delete('/user/{id}', [App\Http\Controllers\AdminController::class, 'destroy']);
    });
});
