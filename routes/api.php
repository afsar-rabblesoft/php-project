<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', [UserController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/question', [UserController::class, 'index']);
    Route::post('/save-answers', [UserController::class, 'save']);
    Route::get('/generate-pdf', [UserController::class, 'pdfgenerate']);

});
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
