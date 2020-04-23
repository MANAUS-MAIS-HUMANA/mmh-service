<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->middleware('api')->group(function () {

    /** @api /api/v1/auth */
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('auth.login');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
    });

});
