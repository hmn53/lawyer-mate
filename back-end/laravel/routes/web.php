<?php

use Carbon\Carbon;
use App\Doc;
use App\CaseTable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderDue;
use App\CustomUser;
use App\Appointment;
use App\Directory;
use App\Notifications\ReminderNotifications;
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

Auth::routes(['verify' => true]);

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
Route::get('/appointment', function () {
    return view('pages/appointment');
});

Route::post('/appointment','PagesController@appointment');
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

Route::get('view/{path}',function($path){
    return response()->file(storage_path('app/docs/' . $path));
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

Route::get('/search/lawyers', function () {
    return view('pages.searchLawyers');
});

//docs
Route::get('/docs/verify/{id}', function ($id) {
    $updateDoc = Doc::find($id);
    $updateDoc->verified = "verified";
    $client = CustomUser::find($updateDoc->upload_by);
    $document = $updateDoc->document_name;
    $description = $updateDoc->description;
    $caseID = $updateDoc->case_id;
    $updateDoc->save();
    $clientName = $client->name;
    $clientEmail = $client->email;
    $data = array('name'=>$clientName, 'email'=>$clientEmail ,'document' =>$document,'caseID'=>$caseID, 'description'=>$description);
    Mail::send('email.doc', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject
            ('Document Verified!');
        $message->from('webportalforlawyers@gmail.com','Hatim');
    });
    return redirect('/docs');
});

Route::get('/docs/unverify/{id}', function ($id) {
    $updateDoc = Doc::find($id);
    $updateDoc->verified = "rejected";
    $updateDoc->save();
    return redirect('/docs');
});

//appointment
Route::get('/appointment/accept/{id}', function ($id) {
    $updateApp = Appointment::find($id);
    $updateApp->accepted = "accepted";
    $user = CustomUser::find($updateApp->user_id);
    $date = $updateApp->date;
    $updateApp->save();
    $name = $user->name;
    $email = $user->email;
    $lawyer = auth()->user();
    $lawyerName = $lawyer->name;
    $lawyerEmail = $lawyer->email;
    $data = array('name'=>[$lawyerName,$name], 'email'=>[$lawyerEmail,$email],'date'=>$date);
    Mail::send('email.appointment', $data, function($message) use ($data) {
        $message->to($data['email'], $data['name'])->subject
            ('Appointment Scheduled!');
        $message->from('webportalforlawyers@gmail.com','Hatim');
    });
    return redirect('/dashboard');
});

Route::get('/appointment/unaccept/{id}', function ($id) {
    $updateApp = Appointment::find($id);
    $updateApp->accepted = "rejected";
    $updateApp->save();
    return redirect('/dashboard');
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


//mail
Route::get('/send/email', 'PagesController@emailSend');
Route::get('/sendbasicemail','MailController@basic_email');
Route::get('/sendhtmlemail','MailController@html_email');
Route::get('welcome/{id}', 'MailController@lawyerWelcome');

//lawbook search
// Route::post('/search/lawbook', function (Request $request) {
//     $q = Input::get ( 'searchTerm' );
//     $laws = Directory::where('name','LIKE','%'.$q.'%')->orWhere('detail','LIKE','%'.$q.'%')->get();
//     if(count($laws) > 0)
//         return view('lawbook')->with('laws',$laws)->withQuery ( $q );
//     else return view ('lawbook')->withMessage('No Details found. Try to search again !');
// });
Route::post('/search/lawbook','PagesController@searchLawbook');

//test
Route::get('/test', function () {
    $user = auth()->user();
    //$user->notify(new Reminder("Welcome to the Web Portal for Lawyers."));
    $name = $user->name;
        $email = $user->email;
        $data = array('name'=>$name, 'email'=>$email);
        Mail::send('email.lawyerWelcome', $data, function($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject
                ('Welcome to the Web Portal');
            $message->from('webportalforlawyers@gmail.com','Hatim');
        });
    return view('/dashboard');
    // return date('Y-d-m');
});
