<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
