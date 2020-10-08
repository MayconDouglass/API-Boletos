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


    Route::get('clientes', 'api\\ClienteAPI@index');
    Route::get('clientes/{id}', 'api\\ClienteAPI@show');
    Route::get('clientes/cgc/{cgc}', 'api\\ClienteAPI@cgc');

    Route::post('clientes/i/', 'api\\ClienteAPI@store');
    Route::post('clientes/u/{id}', 'api\\ClienteAPI@update');
    Route::post('clientes/d/{id}', 'api\\ClienteAPI@destroy');

    Route::get('empresas', 'api\\EmpresaAPI@index');
    Route::get('empresas/{id}', 'api\\EmpresaAPI@show');
    Route::get('empresas/cnpj/{cgc}', 'api\\EmpresaAPI@cgc');
    Route::get('empresas/rest/{auth_rest}', 'api\\EmpresaAPI@rest');
    Route::get('empresas/rest/generator/{cgc}', 'api\\EmpresaAPI@generate_rest');
    Route::get('empresas/clientes/{auth_rest}', 'api\\EmpresaAPI@cliemp');
    Route::get('empresas/contratos/{auth_rest}', 'api\\EmpresaAPI@contratoemp');
    
    Route::post('empresas/i/', 'api\\EmpresaAPI@store');
    Route::post('empresas/u/{auth_rest}', 'api\\EmpresaAPI@update');
    Route::post('empresas/d/{id}', 'api\\EmpresaAPI@destroy');
    Route::post('empresas/d/{auth_rest}/{id}', 'api\\EmpresaAPI@deleteRel');

    Route::get('contratos', 'api\\ContratoAPI@index');
    Route::get('contratos/{id}', 'api\\ContratoAPI@show');
    Route::get('contratos/n/{numero}', 'api\\ContratoAPI@showNumero');

    Route::post('contratos/i/', 'api\\ContratoAPI@store');
    Route::post('contratos/u/{id}', 'api\\ContratoAPI@update');
    Route::post('contratos/u/numero/{numero}', 'api\\ContratoAPI@updateNumero');
    Route::post('contratos/d/{id}', 'api\\ContratoAPI@destroy');
    Route::post('contratos/d/n/{numero}', 'api\\ContratoAPI@destroyAuth');

    Route::get('boletos', 'api\\FinanceiroAPI@index');
    Route::get('boletos/{id}', 'api\\FinanceiroAPI@show');
    Route::get('boletos/n/{numero}', 'api\\FinanceiroAPI@showNumero');




    
    
});


