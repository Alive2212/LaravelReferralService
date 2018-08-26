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
                    Route::get('', 'PreRegisterController@index');
                    Route::post('preregister', 'PreRegisterController@create');
                    Route::get('referralgift', 'RecordsController@referralgift');
                    Route::get('referral', 'ProcessesController@referral');
                    Route::post('key', 'AliveReferralKeyGenerate@generate');
                    Route::get('key', 'AliveReferralKeyGenerate@userPage');
                });
            });
        });
    });
});

