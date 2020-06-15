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

Route::get('/visualisatie', function(){
    return view('visualisatie');
})->name('visualisatie')->middleware('verified');

Route::get('/calculator', ['uses' => 'GebouwenController@create', 'as' => 'calculator'] );

Route::get('/calculator/{type}', ['uses' => 'GebouwenController@create']);

Route::post('/calculator/ruimte', ['uses' => 'GebouwenController@storeRoom']);

Route::post('/calculator/{type}', ['uses' =>'GebouwenController@store']);

Route::get('/contact', 'ContactMessageController@create')->name('contact');

Route::post('/contact', 'ContactMessageController@store')->name('contact.store');

Route::get('/overons', function(){
    return view('overons');
})->name('overons');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/cms', 'DatabaseController@index')->name('cms')->middleware('verified');

Route::get('/cms/{id}/delete', 'DatabaseController@destroy')->middleware('verified');

Route::get('/cms/{id}/edit', 'DatabaseController@edit')->middleware('verified');

Route::put('/cms/{id}/edit', 'DatabaseController@update')->middleware('verified');

Route::get('/cms/create', 'DatabaseController@create')->middleware('verified');

Route::post('/cms/create', 'DatabaseController@store')->middleware('verified');
