<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->middleware('api')->group(function () {
    /** @api /api/v1/auth */
    Route::prefix('auth')->group(function () {
        Route::post('create', 'AuthController@create')->name('auth.create');
        Route::post('password-reset', 'AuthController@passwordReset')->name('auth.passwordReset');
        Route::post('confirm-password-reset/{token}', 'AuthController@confirmPasswordReset')->name('auth.confirmPasswordReset');
    });
});
