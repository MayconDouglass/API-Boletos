<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@form')->name('login');
Route::get('/emp', 'LoginEmpController@form');
Route::post('/login', 'LoginController@Login');
Route::post('/emp/login', 'LoginEmpController@Login');
Route::group(['middleware' => ['api']], function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->action('LoginController@form');
    })->name('logout');
});
