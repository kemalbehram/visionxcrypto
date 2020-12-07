<?php

use App\Http\Controllers\Api\AuthenticateController;
use Illuminate\Http\Request;

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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/callback1', 'CallbackController@index')->name('callback1');

Route::post('signup', [AuthenticateController::class, 'signup'])->name('signup');
Route::post('login', [AuthenticateController::class, 'login'])->name('login');
Route::post('verifycode', [AuthenticateController::class, 'verifycode'])->name('verifycode');
Route::post('forgotpassword', [AuthenticateController::class, 'forgotpassword'])->name('forgotpassword');
Route::post('fpnewpassword', [AuthenticateController::class, 'forgotpassword_newpassword'])->name('forgotpassword_newpassword');
