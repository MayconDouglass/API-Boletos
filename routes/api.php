<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/login', 'api\\AuthController@login');
Route::post('auth/emp/login', 'api\\AuthEmpController@login')->middleware();


Route::group(['middleware'=>['apiJWT']], function(){
    
    Route::get('auth/logout', function () {
        Auth::logout();
        return redirect()->action('api\\AuthController@login');
    })->name('logout');
    
    Route::get('auth/emp/logout', function () {
        Auth::logout();
        return redirect()->action('api\\AuthEmpController@login');
    })->name('logoutEmp');

    Route::post('auth/logout', 'api\\AuthController@logout');
    Route::post('auth/me', 'api\\AuthController@me');
    Route::post('auth/refresh', 'api\\AuthController@refresh');
    
    Route::post('auth/emp/logout', 'api\\AuthEmpController@logout');
    Route::post('auth/emp/me', 'api\\AuthEmpController@me');
    Route::post('auth/emp/refresh', 'api\\AuthEmpController@refresh');


    Route::get('clientes', 'api\\ClienteApi@index');
    Route::get('clientes/{id}', 'api\\ClienteApi@show');
    Route::get('clientes/cgc/{cgc}', 'api\\ClienteApi@cgc');

    Route::post('clientes/i/', 'api\\ClienteApi@store');
    Route::post('clientes/u/{id}', 'api\\ClienteApi@update');
    Route::post('clientes/d/{id}', 'api\\ClienteApi@destroy');

    Route::get('empresas', 'api\\EmpresaApi@index');
    Route::get('empresas/{id}', 'api\\EmpresaApi@show');
    Route::get('empresas/cnpj/{cgc}', 'api\\EmpresaApi@cgc');
    Route::get('empresas/rest/{auth_rest}', 'api\\EmpresaApi@rest');
    Route::get('empresas/rest/generator/{cgc}', 'api\\EmpresaApi@generate_rest');
    Route::get('empresas/clientes/{auth_rest}', 'api\\EmpresaApi@cliemp');
    Route::get('empresas/contratos/{auth_rest}', 'api\\EmpresaApi@contratoemp');
    
    Route::post('empresas/i/', 'api\\EmpresaApi@store');
    Route::post('empresas/u/{auth_rest}', 'api\\EmpresaApi@update');
    Route::post('empresas/d/{id}', 'api\\EmpresaApi@destroy');
    Route::post('empresas/d/{auth_rest}/{id}', 'api\\EmpresaApi@deleteRel');

    Route::get('contratos', 'api\\ContratoApi@index');
    Route::get('contratos/n/{id}', 'api\\ContratoApi@show');





    
    
});


