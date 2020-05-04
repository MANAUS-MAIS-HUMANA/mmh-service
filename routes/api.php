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
    Route::apiResource('usuario', 'UsuarioController');
//    Route::prefix('usuario')->group(function () {
//        Route::get('/', 'UsuarioController@getAll')->name('usuario.getAll');
//        Route::get('{id}', 'UsuarioController@getById')->name('usuario.getById');
//        Route::put('{id}', 'UsuarioController@update')->name('usuario.update');
//        Route::delete('{id}', 'UsuarioController@delete')->name('usuario.delete');
//    });

});
