<?php

use Carbon\Carbon;
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
Route::get('/reminder', 'PagesController@reminder');
Route::post('/reminder', 'PagesController@storeReminder');
Route::get('/profile', 'PagesController@profile');
Route::get('/home', function () {
    return redirect('/dashboard');
});
Route::get('/docs','PagesController@docs');
Route::get('docs/upload', 'PagesController@uploaddocs');
Route::get('cases/add', 'PagesController@addcase');
Route::get('clients', 'PagesController@clients');
Route::post('/cases/add','PagesController@store');
Route::post('/docs/upload','PagesController@upload');
Route::get('/cases', 'PagesController@cases');
Route::get('/cases/current', 'PagesController@currentcases');
Route::get('download/{path}', function ($path) {
    return response()->download(storage_path('app/docs/' . $path));
});
Route::get('/test', function () {
    event(new App\Events\ReminderAdded(auth()->user()->id,auth()->user()->name,'Appointment',auth()->user()->type,'TEST DESCRIPTION',Carbon::now()->toDateTimeString()));
    //return "Event has been sent!";
    return redirect('/dashboard');
});

