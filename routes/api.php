<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->group(function () {

    /** @api /api/v1/auth */
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('auth.login');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        Route::post('create', 'AuthController@create')->name('auth.create');
        Route::post('password-reset', 'AuthController@passwordReset')->name('auth.passwordReset');
        Route::post('confirm-password-reset', 'AuthController@confirmPasswordReset')->name('auth.confirmPasswordReset');
    });

    /** @api /api/v1/usuario */
    Route::prefix('usuario')->group(function () {
        Route::post('/', 'UsuarioController@getAll')->name('usuario.getAll');
        Route::post('{id}', 'UsuarioController@getById')->name('usuario.getById');
    });

});
