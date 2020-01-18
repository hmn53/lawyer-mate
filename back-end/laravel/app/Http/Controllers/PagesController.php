<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Events\ReminderAdded;
use App\CaseTable;
use App\Doc;
use App\Reminder;
use App\Client;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function lawbook(){
        return view('pages/lawbook');
    }

    public function index(){
        return view('pages/index');
    }

    public function docs(){
        return view('pages.docs');
    }

    public function uploaddocs(){
        return view('pages/upload');
    }

    public function addcase(){
        return view('pages/addcase');
    }

    public function clients(){
        return view('pages/clients');
    }

    public function reminder(){
        $user = auth()->user();
        $data = Reminder::where('user_id',$user->id)->get();
        if(strcmp($user->type,"lawyer")==0){
            $client_id=Client::select('client_id')->where('lawyer_id',$user->id)->get();
            $a = array_values($client_id->all());
            $data_client = Reminder::whereIn('user_id',$a)->get();
            return view('pages/reminder')->with('data',$data)->with('data_client',$data_client);
        }
        return view('pages.reminder')->with('data',$data);
    }

    public function cases(){
        return view('pages/cases');
    }

    public function currentcases(){
        return view('pages/currentcases');
    }

    public function store(Request $request){
        $request->validate([
            'caseno' => 'required',
            'description' => 'required',
        ]);
        $name = $request->input('clientname');
        $client_id = DB::table('customusers')->select('id')->where('name',$name)->get();
        
        $result= json_decode($client_id,true);
        
         foreach($result as $data){
             $id = $data['id'];
         }
         
        $var = new CaseTable;
        $var->case_no=$request->input('caseno');
        $var->lawyer_id = auth()->user()->id;
        $var->client_id= $id;
        $var->judge_name= $request->input('judgename');
        $var->court_type = $request->input('courttype');
        $var->category = $request->input('category');
        $var->case_members = $request->input('casemembers');
        $var->status = $request->input('status');
        $var->date_of_filing = $request->input('filingdate');
        $var->opponent = $request->input('opponent');
        $var->description = $request->input('description');
        $var->summary = $request->input('summary');
        $var->background = $request->input('background');
        $var->save();

        return redirect('/dashboard');
    }
    public function storeReminder(Request $request){
        $request->validate([
            // 'case_no' => 'required',
            'description' => 'required',
            'type' => 'required',
            'reminddate'=>'required',
        ]);
        $var = new Reminder;
       $var->user_id =auth()->user()->id;
       $var->case_no = $request->input('case_no');
       $var->description = $request->input('description');
       $var->remind_date = $request->input('reminddate');
       $var->type = $request->input('type');
        $var->save();
        event(new ReminderAdded(auth()->user()->id,auth()->user()->name,'Appointment',auth()->user()->type,$request->input('description'),Carbon::now()->toDateTimeString()));
        return redirect('/dashboard');
    }
    public function upload(Request $request){
        $request->validate([
            'caseno' => 'required',
            'description' => 'required',
            'docname' => 'required',
            'doc' => 'file|max:1999',
        ]);
        $user_id = auth()->user()->id;
        $var = new Doc;
        $var->upload_by = $user_id;
        $var->case_id = $request->input('caseno');
        $var->document_name = $request->input("docname");
        $var->description = $request->input("description");
        //$var->upload_on = $date;
        $var->path = $request->doc->getClientOriginalName();
        $var->save();
        $path= $request->doc->storeAs('docs', $request->doc->getClientOriginalName());
        return redirect('/docs');

    }
   

    public function services(){
        $var = array(
            'title'=>'Services',
            'services'=>['Web','Android','Node','C++','Javascript','Java','C']
        );
        return view('pages/services')->with($var);
    }

    public function profile()
    {
        return view('pages/profile');
    }
}
