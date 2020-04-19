<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->middleware('api')->group(function () {
    /** @api /api/v1/auth */
    Route::prefix('auth')->group(function () {
        /** @api /api/v1/auth/create */
        Route::post('create', 'AuthController@create')->name('user.create');
    });
});
