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

$router->group([
    'prefix' => 'api',
    'namespace' => 'Alive2212\LaravelReferralService\Http\Controllers'
], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
        $router->group(['prefix' => 'alive'], function () use ($router) {
            $router->group(['prefix' => 'referral'], function () use ($router) {
            });
        });
        $router->group(['prefix' => 'custom'], function () use ($router) {
            $router->group(['prefix' => 'alive'], function () use ($router) {
                $router->group(['prefix' => 'referral'], function () use ($router) {
                });
            });
        });
    });
});