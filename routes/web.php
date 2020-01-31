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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/get', 'UserController@get');
Route::get('/event/get', 'EventController@get');
Route::post('/event/store', 'EventController@store');
Route::get('/income/get', 'IncomeController@get');
Route::post('/income/store', 'IncomeController@store');
Route::get('/outcome/get', 'OutcomeController@get');
Route::post('/outcome/store', 'OutcomeController@store');
Route::post('/item/store', 'ItemController@store');
