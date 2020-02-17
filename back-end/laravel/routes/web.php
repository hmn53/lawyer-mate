<?php

use Carbon\Carbon;
use App\Doc;
use App\CaseTable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderDue;
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
$user = auth()->user();
Route::get('/', 'PagesController@index');

Route::get('/lawbook','PagesController@lawbook');

Route::get('/services','PagesController@services');
Auth::routes();
Route::get('/dashboard', 'DashboardController@index');
Route::get('/reminder', 'PagesController@reminder');
Route::post('/reminder', 'PagesController@storeReminder');
Route::get('/profile', 'PagesController@profile');
// Route::get('/home', function () {
//     return redirect('/dashboard');
// });
Route::get('/home','PagesController@home');
Route::get('/admin', function () {
    return view("pages\admin");
});
Route::get('/docs','PagesController@docs');
Route::get('docs/upload', 'PagesController@uploaddocs');
Route::get('cases/add', 'PagesController@addcase');
Route::get('clients', 'PagesController@clients');
Route::get('/lawyers', function () {
    return view('pages/lawyers');
});
Route::post('/cases/add','PagesController@store');
Route::post('/docs/upload','PagesController@upload');
Route::get('/cases', 'PagesController@cases');
Route::get('/cases/current', 'PagesController@currentcases');
Route::get('/cases/show/{id}',function($id){
    $case = CaseTable::find($id);
    return view('pages.showCase')->with('case',$case);
});
Route::get('download/{path}', function ($path) {
    return response()->download(storage_path('app/docs/' . $path));
});

Route::get('/admin/cases', function () {
    return view('admin.cases');
});
Route::get('/admin/clients', function () {
    return view('admin.clients');
});
Route::get('/admin/docs', function () {
    return view('admin.docs');
});
Route::get('/admin/reminder', function () {
    return view('admin.reminder');
});

Route::get('/test', function () {
    event(new App\Events\ReminderAdded(auth()->user()->id,auth()->user()->name,'Appointment',auth()->user()->type,'TEST DESCRIPTION',Carbon::now()->toDateTimeString()));
    //return "Event has been sent!";
    return redirect('/dashboard');
});

Route::get('/email', function () {
    Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('earnmoneyonline5253@gmail.com');
	});
});

//docs
Route::get('/docs/verify/{id}', function ($id) {
    $updateDoc = Doc::find($id);
    $updateDoc->verified = "verified";
    $updateDoc->save();
    return redirect('/docs');
});

Route::get('/docs/unverify/{id}', function ($id) {
    $updateDoc = Doc::find($id);
    $updateDoc->verified = "rejected";
    $updateDoc->save();
    return redirect('/docs');
});
//admin
Route::post('/admin/add', 'PagesController@addAdmin');
Route::post('/admin/add/case', 'PagesController@addAdminCase');
Route::post('/admin/add/client', 'PagesController@addAdminClient');
Route::post('/admin/add/docs', 'PagesController@addAdminDoc');
Route::post('/admin/add/reminder', 'PagesController@addAdminReminder');
Route::post('/admin/remove/{id}', 'PagesController@deleteAdmin');
Route::post('/admin/remove/case/{id}', 'PagesController@deleteCase');
Route::post('/admin/remove/client/{id}', 'PagesController@deleteClient');
Route::post('/admin/remove/doc/{id}', 'PagesController@deleteDoc');
Route::post('/admin/remove/reminder/{id}', 'PagesController@deleteReminder');

