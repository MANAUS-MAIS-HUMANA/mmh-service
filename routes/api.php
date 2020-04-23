<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->middleware('api')->group(function () {

    /** @api /api/v1/usuario */
    Route::prefix('usuario')->group(function () {
        Route::post('create', 'UsuarioController@create')->name('usuario.create');
        Route::post('password-reset', 'UsuarioController@passwordReset')->name('usuario.passwordReset');
        Route::post('confirm-password-reset', 'UsuarioController@confirmPasswordReset')->name('usuario.confirmPasswordReset');
    });

});
