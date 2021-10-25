<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]); /*Activando la verificación de correo*/

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify', 'VerifyController@show')->name('verify');

Route::group(["middleware" => 'verify2fa'], function () {
    Route::post('/verify', 'VerifyController@verify')->name('verify');
    Route::get('/resend', 'VerifyController@resend')->name('resend');
});
