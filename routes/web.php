<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthHomeController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('auth.index');
// });

Route::post('/susbcribe', [AuthHomeController::class, 'subscribe'])->name('subscribe');

Route::group(['middleware' => ['revalidate_back_history']], function () {
    Route::get('/', [AuthHomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'auth', 'middleware' => ['custom_guest']], function () {
        Route::get('/registration', [AuthController::class, 'getRegister'])->name('getRegister');
        Route::post('/registration', [AuthController::class, 'postRegister'])->name('postRegister');

        Route::post('/check_email_unique', [AuthController::class, 'check_email_unique'])->name('check_email_unique');
        Route::get('/verify-email/{verification_code}', [AuthController::class, 'verify_email'])->name('verify_email');

        Route::get('/login', [AuthController::class, 'getLogin'])->name('getLogin');
        Route::post('/login', [AuthController::class, 'postLogin'])->name('postLogin');

        Route::post('/ajax-login', [AuthController::class, 'ajaxLogin'])->name('ajaxLogin');

        Route::get('/forget-password', [AuthController::class, 'getForgetPassword'])->name('getForgetPassword');
        Route::post('/forget-password', [AuthController::class, 'postForgetPassword'])->name('postForgetPassword');

        Route::get('/reset-password/{reset_code}', [AuthController::class, 'getResetPassword'])->name('getResetPassword');
        Route::post('/reset-password/{reset_code}', [AuthController::class, 'postResetPassword'])->name('postResetPassword');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('custom_auth');

    Route::group(['prefix' => 'profile', 'middleware' => ['custom_auth']], function () {
        Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
        Route::get('/edit-profile', [ProfileController::class, 'edit_profile'])->name('edit_profile');
        Route::put('/edit-profile', [ProfileController::class, 'update_profile'])->name('update_profile');
        Route::get('/change-password', [ProfileController::class, 'change_password'])->name('change_password');
        Route::post('/update-password', [ProfileController::class, 'update_password'])->name('update_password');
    });
});