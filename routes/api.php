<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'api\\AuthController@login');
Route::post('/login', 'api\\LoginAPI@Login');
Route::get('teste/login','api\\LoginApi@form');


Route::group(['middleware'=>['apiJWT']], function(){
    Route::get('teste/logout', function () {
        Auth::logout();
        return redirect()->action('LoginApi@form');
    })->name('logout');

    Route::post('auth/logout', 'api\\AuthController@logout');
    Route::post('auth/me', 'api\\AuthController@me');
    Route::get('clientes','api\\ClienteApi@index');
});


