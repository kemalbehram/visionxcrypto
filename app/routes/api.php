<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ValidateController;
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
Route::post('resendcode', [AuthenticateController::class, 'resendcode'])->name('resendcode');
Route::post('forgotpassword', [AuthenticateController::class, 'forgotpassword'])->name('forgotpassword');
Route::post('fpnewpassword', [AuthenticateController::class, 'forgotpassword_newpassword'])->name('forgotpassword_newpassword');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('buyairtime', [TransactionController::class, 'buyairtime'])->name('buyairtime');

    Route::get('dataplans/{network}', [ProductsController::class, 'listdata'])->name('listdata');
    Route::post('buydata', [TransactionController::class, 'buydata'])->name('buydata');

    Route::get('tvplans/{tv}', [ProductsController::class, 'listtv'])->name('listtv');
    Route::post('validatetv', [ValidateController::class, 'validatetv'])->name('validatetv');
    Route::post('buytv', [TransactionController::class, 'buytv'])->name('buydata');

    Route::post('sendsms', [TransactionController::class, 'sendsms'])->name('sendsms');

    Route::post('validatemeter', [ValidateController::class, 'validatemeter'])->name('validatemeter');
    Route::post('paypower', [TransactionController::class, 'paypower'])->name('paypower');

    Route::get('mybank', [ProductsController::class, 'myBank'])->name('myBank');
    Route::post('banktransfer', [TransactionController::class, 'banktransfer'])->name('banktransfer');

    Route::get('bankslist', [ProductsController::class, 'listBanks'])->name('listBanks');
    Route::post('validatebank', [ValidateController::class, 'validatebank'])->name('validatebank');
    Route::post('otherbanktransfer', [TransactionController::class, 'otherbanktransfer'])->name('otherbanktransfer');

    Route::post('validateuser', [ValidateController::class, 'validateuser'])->name('validateuser');
    Route::post('wallettransfer', [TransactionController::class, 'walletransfer'])->name('walletransfer');


});
