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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/visualisatie', function(){
    return view('visualisatie');
})->name('visualisatie')->middleware('verified');

Route::get('/contact', 'ContactMessageController@create')->name('contact');

Route::post('/contact', 'ContactMessageController@store')->name('contact.store');

Route::get('/overons', function(){
    return view('overons');
})->name('overons');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
