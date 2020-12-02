<?php

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

Route::get('daftarulang', function () {
    return view('daftarulang');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('daftar', 'DaftarController');
Route::post('daftar/update', 'DaftarController@update')->name('daftar.update');
Route::get('daftar/destroy/{id}', 'DaftarController@destroy');

Route::resource('absen', 'AbsenController');
Route::post('absen/update', 'AbsenController@update')->name('absen.update');
Route::get('absen/destroy/{id}', 'AbsenController@destroy');
Route::post('absens', 'SearchController@checkScore');
Route::get('/invoice/print', 'AbsenController@generateInvoice');
