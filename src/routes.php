<?php

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

Route::namespace('Alive2212\LaravelReferralService\Http\Controllers')
    ->prefix('api')
    ->group(function () {
    Route::prefix('v1')->group(function () {
        Route::prefix('alive')->group(function () {
            Route::prefix('referral')->group(function () {
                // resources
            });
        });
        Route::prefix('custom')->group(function () {
            Route::prefix('alive')->group(function () {
                Route::prefix('referral')->group(function () {
                    Route::get('', 'AliveReferralPreRegisterController@index');
                    Route::post('preregister', 'AliveReferralPreRegisterController@create');
                    Route::get('gift', 'AliveReferralRecordsController@referralgift');
                    Route::get('add', 'AliveReferralRecordsController@addUserToDone');
                    Route::get('referral', 'AliveReferralProcessesController@referral');
                    Route::get('key', 'AliveReferralKeyGenerate@generate');
                    Route::get('generated', 'AliveReferralKeyGenerate@userPage');
                });
            });
        });
    });
});

