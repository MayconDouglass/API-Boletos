<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@form')->name('login');
Route::post('/login', 'LoginController@Login');
Route::group(['middleware' => ['api']], function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->action('LoginController@form');
    })->name('logout');
});
