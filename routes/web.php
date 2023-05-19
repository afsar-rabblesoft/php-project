<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Models\Admin;
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [AdminController::class, 'show'])->name('dashboard');
    Route::get('/user', [AdminController::class, 'showUsers'])->name('users');
    Route::post('/user', [AdminController::class, 'add'])->name('adduser');
    Route::get('/user/{id}', [AdminController::class, 'userdetail'])->name('add-detail');
    Route::put('/user/{id}', [AdminController::class,'update'])->name('user-update');
    Route::delete('/user/{id}', [AdminController::class,'destroy'])->name('user-delete');

    Route::get('/setting', [SettingController::class, 'index'])->name('settings');
    Route::post('/addsurvey', [SettingController::class, 'addtitle'])->name('add-title');
    Route::post('/questions', [SettingController::class, 'addquestions'])->name('add-questions');
    Route::get('/survey', [SettingController::class, 'surveys'])->name('surveys-page');



});
Route::get('/password-reset/{token}', [AdminController::class, 'resetPassword'])->name('password.reset');
Route::post('/password-reset-update', [AdminController::class, 'updatePassword'])->name('password.reset.update');
Route::get('/forgot-password', [AdminController::class, 'forgotPassword'])->name('forgot.password');
Route::get('/congratulation', [AdminController::class, 'congratulation'])->name('congratulation');

Route::get('/admin/login', [AdminController::class, 'index'])->name('login');
Route::post('/admin/login', [AdminController::class, 'login']);
