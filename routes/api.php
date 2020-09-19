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
    Route::post('clientes/i/','api\\ClienteApi@store');
    Route::post('clientes/u/{id}','api\\ClienteApi@update');
    Route::post('clientes/d/{id}','api\\ClienteApi@destroy');

    Route::get('empresas','api\\EmpresaApi@index');
    Route::get('empresas/{id}','api\\EmpresaApi@show');
    Route::get('empresas/cnpj/{cgc}','api\\EmpresaApi@cgc');
    Route::get('empresas/rest/{hash}','api\\EmpresaApi@rest');
    Route::get('empresas/rest/generator/{cgc}','api\\EmpresaApi@generate_rest');
    Route::post('empresas/i/','api\\EmpresaApi@store');
    Route::post('empresas/u/{id}','api\\EmpresaApi@update');
});


