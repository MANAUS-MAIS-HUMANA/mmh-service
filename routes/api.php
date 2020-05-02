<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->middleware('api')->group(function () {

    /** @api /api/v1/auth */
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('auth.login');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        Route::post('create', 'UsuarioController@create')->name('auth.create');
        Route::post('password-reset', 'UsuarioController@passwordReset')->name('auth.passwordReset');
        Route::post('confirm-password-reset', 'UsuarioController@confirmPasswordReset')->name('auth.confirmPasswordReset');
    });

    /** @api /api/v1/usuario */
    Route::prefix('usuario')->group(function () {
        Route::post('/', 'UsuarioController@getAll')->name('usuario.getAll');
    });

});
