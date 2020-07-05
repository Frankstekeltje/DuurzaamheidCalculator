<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/overons', function(){
    return view('overons');
})->name('overons');

Route::get('/calculator', 'GebouwenController@index')->name('calculator')->middleware('verified');

Route::get('/calculator/{type}', 'GebouwenController@create')->middleware('verified');

Route::post('/calculator/{type}', 'GebouwenController@store')->middleware('verified');

Route::get('/calculator/{id}/edit', 'GebouwenController@edit')->middleware('verified');

Route::put('/calculator/{id}/edit', 'GebouwenController@update')->middleware('verified');

Route::get('/contact', 'ContactMessageController@create')->name('contact');

Route::post('/contact', 'ContactMessageController@store')->name('contact.store');

Route::get('/home', 'HomeController@index', 'GebouwenController@index')->name('home')->middleware('verified');

Route::get('/overzicht', 'GebouwenController@indexBuilding')->middleware('verified')->name('overzicht');

Route::get('/gebouwOverzicht/{id}', 'GebouwenController@show')->middleware('verified');

Route::get('/cms', 'DatabaseController@index')->name('cms')->middleware('verified');

Route::get('/cms/{id}/delete', 'DatabaseController@destroy')->middleware('verified');

Route::get('/cms/{id}/edit', 'DatabaseController@edit')->middleware('verified');

Route::put('/cms/{id}/edit', 'DatabaseController@update')->middleware('verified');

Route::get('/cms/create', 'DatabaseController@create')->middleware('verified');

Route::post('/cms/create', 'DatabaseController@store')->middleware('verified');
