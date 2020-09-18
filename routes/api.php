<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'api\\AuthController@login');


Route::group(['middleware'=>['apiJWT']], function(){
    Route::get('auth/logout', function () {
        Auth::logout();
        return redirect()->action('api\\AuthController@login');
    })->name('logout');

    Route::post('auth/logout', 'api\\AuthController@logout');
    Route::post('auth/me', 'api\\AuthController@me');
    Route::post('auth/refresh', 'api\\AuthController@refresh');

    Route::get('clientes','api\\ClienteApi@index');
    Route::get('clientes/{id}','api\\ClienteApi@show');
    Route::get('clientes/cgc/{cgc}','api\\ClienteApi@cgc');
});


