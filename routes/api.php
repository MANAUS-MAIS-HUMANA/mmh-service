<?php

use Illuminate\Support\Facades\Route;

/** @api /api/v1/ */
Route::prefix('v1')->group(function () {

    /** @api /api/v1/auth */
    Route::prefix('auth')->group(function () {
        Route::post('login', 'AuthController@login')->name('auth.login');
        Route::post('logout', 'AuthController@logout')->name('auth.logout');
        Route::post('create', 'AuthController@create')->name('auth.create');
        Route::get('refresh', 'AuthController@refresh')->name('auth.refresh');
        Route::post('password-reset', 'AuthController@passwordReset')->name('auth.passwordReset');
        Route::post('confirm-password-reset', 'AuthController@confirmPasswordReset')->name('auth.confirmPasswordReset');
    });

    /** @api /api/v1/usuario */
    Route::apiResource('usuario', 'UsuarioController')->parameter('usuario', 'id')->except('destroy');
    Route::prefix('usuario')->group(function () {
        Route::put('{id}/set-status', 'UsuarioController@setStatus')->name('usuario.setStatus');
        Route::put('{id}/set-password', 'UsuarioController@setPassword')->name('usuario.setPassword');
    });

    Route::prefix('parceiros')->group(function () {
        Route::get('/', 'ParceiroController@get')->name('parceiros.get');
        Route::get('/{id}', 'ParceiroController@find')->name('parceiros.getbyid');
        Route::post('/', 'ParceiroController@store')->name('parceiros.save');
        Route::put('/{id}', 'ParceiroController@update')->name('parceiros.update');
        Route::delete('/{id}', 'ParceiroController@delete')->name('parceiros.delete');
    });

    Route::prefix('doadores')->group(function () {
        Route::get('/ranking', 'DoadorController@getRanking')->name('doadores.getRanking');
    });

    Route::prefix('beneficiarios')->group(function () {
        Route::get('/', 'BeneficiarioController@get')->name('beneficiarios.get');
        Route::get('/{id}', 'BeneficiarioController@find')->name('beneficiarios.getbyid');
        Route::post('/', 'BeneficiarioController@store')->name('beneficiarios.save');
        Route::put('/{id}', 'BeneficiarioController@update')->name('beneficiarios.update');
        Route::delete('/{id}', 'BeneficiarioController@delete')->name('beneficiarios.delete');
    });
});
