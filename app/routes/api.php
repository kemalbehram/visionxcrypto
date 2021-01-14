<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\OthersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ValidateController;
use App\Http\Controllers\Api\VerificationController;
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
Route::post('/sellcallback', 'CallbackController@sellcallback')->name('sellcallback');

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

    Route::get('transfers', [HistoryController::class, 'transfers'])->name('transfers');
    Route::get('mybank', [ProductsController::class, 'myBank'])->name('myBank');
    Route::post('banktransfer', [TransactionController::class, 'banktransfer'])->name('banktransfer');

    Route::get('bankslist', [ProductsController::class, 'listBanks'])->name('listBanks');
    Route::post('validatebank', [ValidateController::class, 'validatebank'])->name('validatebank');
    Route::post('otherbanktransfer', [TransactionController::class, 'otherbanktransfer'])->name('otherbanktransfer');

    Route::post('validateuser', [ValidateController::class, 'validateuser'])->name('validateuser');
    Route::post('wallettransfer', [TransactionController::class, 'walletransfer'])->name('walletransfer');

    Route::get('mybalance', [ProductsController::class, 'myBalance'])->name('myBalance');

    Route::get('showvxcards', [HistoryController::class, 'showVXCs'])->name('showVXCs');
    Route::get('cardtransactions/{id}', [HistoryController::class, 'transactionsVXC'])->name('transactionsVXC');
    Route::get('cardamount/{id}', [HistoryController::class, 'getVXC'])->name('getVXC');
    Route::post('createvxcard', [TransactionController::class, 'createVXC'])->name('createVXC');
    Route::post('deletevxcard', [TransactionController::class, 'deleteVXC'])->name('deleteVXC');
    Route::post('fundvxcard', [TransactionController::class, 'fundVXC'])->name('fundVXC');
    Route::post('withdrawvxcard', [TransactionController::class, 'withdrawVXC'])->name('withdrawVXC');

    Route::get('notifications', [HistoryController::class, 'showNotifications'])->name('showNotifications');
    Route::get('readnotifications', [OthersController::class, 'readNotifications'])->name('readNotifications');

    Route::post('updatepin', [AuthenticateController::class, 'updatepin'])->name('updatepin');

    Route::post('createInvestment', [TransactionController::class, 'createInvestment'])->name('createInvestment');
    Route::get('investmentdetails/{id}', [HistoryController::class, 'investmentdetails'])->name('investmentdetails');

    Route::post('verification2a', [VerificationController::class, 'verification2a'])->name('verification2a');
    Route::post('verification2b', [VerificationController::class, 'verification2b'])->name('verification2b');
    Route::post('verification3a', [VerificationController::class, 'verification3a'])->name('verification3a');
    Route::post('verification3b', [VerificationController::class, 'verification3b'])->name('verification3b');
    Route::get('vstatus', [VerificationController::class, 'vstatus'])->name('vstatus');

    Route::get('invoice', [HistoryController::class, 'invoicel5'])->name('invoicel5');
    Route::get('invoice/{month}/{year}', [HistoryController::class, 'invoicemy'])->name('invoicemy');
    Route::get('allinvoice', [HistoryController::class, 'invoice'])->name('invoice');

    Route::post('password', [OthersController::class, 'password'])->name('password');

    Route::post('uploadpicture', [OthersController::class, 'uploadprofile'])->name('uploadprofile');


    Route::get('getrate/{currency}/{type}', [ProductsController::class, 'getRate'])->name('getRate');

    Route::post('buycrypto', [TransactionController::class, 'buycrypto'])->name('buycrypto');

    Route::post('sellcrypto', [TransactionController::class, 'sellcrypto'])->name('sellcrypto');

    Route::post('lockaccount', [OthersController::class, 'lockaccount'])->name('lockaccount');



});
