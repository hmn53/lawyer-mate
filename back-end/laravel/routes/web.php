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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'PagesController@index');

Route::get('/lawbook','PagesController@lawbook');

Route::get('/services','PagesController@services');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::get('/profile', 'PagesController@profile');

Route::get('docs/upload', 'PagesController@uploaddocs');
Route::get('cases/add', 'PagesController@addcase');
Route::get('clients', 'PagesController@clients');
Route::post('/cases/add','PagesController@store');
