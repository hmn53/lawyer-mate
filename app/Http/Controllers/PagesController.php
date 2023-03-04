<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use DB;
use App\Events\ReminderAdded;
use App\CaseTable;
use App\CustomUser;
use App\Doc;
use App\Reminder;
use App\Client;
use Carbon\Carbon;
use Auth;
use App\Appointment;
use App\Directory;
use App\LawyerProfile;
use App\Hearing;

class PagesController extends Controller
{
    public function lawbook(){
        if(Auth::check())
            return view('pages/lawbook');
        else
            return redirect("/login");
    }

    public function index(){
        if(Auth::check())
            return redirect("/dashboard");
        return view('pages/index');
    }

    public function docs(){
        if(Auth::check())
            return view('pages.docs');
        else
            return redirect("/login");
    }

    public function uploaddocs(){
        if(Auth::check())
            return view('pages/upload');
        else
            return redirect("/login");
    }

    public function addcase(){
        if(Auth::check())
            return view('pages/addcase');
        else
            return redirect("/login");
    }

    public function clients(){
        if(Auth::check())
            return view('pages/clients');
        else
            return redirect("/login");
    }

    public function reminder(){
        if(Auth::check()){
            $user = auth()->user();
            $data = Reminder::where('user_id',$user->id)->get();
            if(strcmp($user->type,"lawyer")==0){
                $client_id=Client::select('client_id')->where('lawyer_id',$user->id)->get();
                $a = array_values($client_id->all());
                $data_client = Reminder::whereIn('user_id',$a)->get();
                return view('pages/reminder')->with('data',$data)->with('data_client',$data_client);
            }
            return view('pages.reminder')->with('data',$data);
        }else
            return redirect("/login");

    }


    public function cases(){
        if(Auth::check())
            return view('pages/cases');
        else
            return redirect("/login");
    }

    public function home(){
        if(Auth::check()){
            $user = auth()->user();
            if(strcmp($user->type,"admin")==0){
                return view('pages/admin');
            }
            else
                return view('dashboard');
        } else
            return redirect("/login");

    }

    // public function currentcases(){
    //     return view('pages/currentcases');
    // }

    public function store(Request $request){
        if(Auth::check()){
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
            $var->type = $request->input('type');
            $var->court_number = $request->input('court_number');
            $var->filing_number = $request->input('filing_number');
            $var->registration_number = $request->input('registration_number');
            $var->registration_date = $request->input('registration_date');
            $var->category = $request->input('category');
            $var->case_members = $request->input('casemembers');
            $var->penal_code = $request->input('penal_code');
            $var->petitioner = $request->input('petitioner');
            $var->respondent = $request->input('respondent');
            $var->status = $request->input('status');
            $var->date_of_filing = $request->input('filingdate');
            $var->opponent = $request->input('opponent');
            $var->description = $request->input('description');
            $var->comments = $request->input('comments');
            $var->summary = $request->input('summary');
            $var->background = $request->input('background');
            $var->save();

            return redirect('/dashboard');
        }

    }
    public function storeReminder(Request $request){
        if(Auth::check()){
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

    }

    public function appointment(Request $request){
        if(Auth::check()){
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'date'=>'required',
            ]);
            $lawyer_id = CustomUser::select('id')->where('name', $request->input('lawyer_name'))->get();
            foreach($lawyer_id->all() as $id){
                $l_id = $id->id;
            }
            $var = new Appointment;
           $var->user_id =auth()->user()->id;
           $var->title = $request->input('title');
           $var->lawyer_id = $l_id;
           $var->lawyer_name = $request->input('lawyer_name');
           $var->description = $request->input('description');
           $var->date = $request->input('date');
           $var->save();
           return redirect('/dashboard');
        }
    }
    public function upload(Request $request){
        if(Auth::check()) {
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
    }


    // public function services(){
    //     $var = array(
    //         'title'=>'Services',
    //         'services'=>['Web','Android','Node','C++','Javascript','Java','C']
    //     );
    //     return view('pages/services')->with($var);
    // }

    public function profile()
    {
        if(Auth::check())
            return view('pages/profile');
        else
            return redirect("/login");
    }

    //admin
    public function addAdmin(Request $request){
        $var = new CustomUser;
        $var->name=$request->input('name');
        $var->email = $request->input('email');
        $var->password= $request->input('password');
        $var->type = $request->input('type');
        $var->save();
        return redirect('/admin');
    }
    public function addAdminCase(Request $request){
        $var = new CaseTable;
        $var->case_no=$request->input('caseno');
        $var->lawyer_id = $request->input('lawyerid');
        $var->client_id= $request->input('clientid');
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
        return redirect('/admin');
    }
    public function addAdminClient(Request $request){
        $var = new Client;
        $var->client_name=$request->input('clientname');
        $var->lawyer_id = $request->input('lawyerid');
        $var->client_id= $request->input('clientid');
        $var->lawyer_name= $request->input('lawyername');
        $var->case_id=$request->input('caseid');
        $var->save();
        return redirect('/admin/clients');
    }
    public function addAdminDoc(Request $request){
        $request->validate([
            'caseno' => 'required',
            'description' => 'required',
            'docname' => 'required',
            'doc' => 'file|max:1999',
        ]);
        $var = new Doc;
        $var->upload_by = $request->input('id');
        $var->case_id = $request->input('caseno');
        $var->document_name = $request->input("docname");
        $var->description = $request->input("description");
        //$var->upload_on = $date;
        $var->path = $request->doc->getClientOriginalName();
        $var->save();
        $path= $request->doc->storeAs('docs', $request->doc->getClientOriginalName());
        return redirect('/admin/docs');

    }
    public function addAdminReminder(Request $request){
        $var = new Reminder;
        $var->user_id = $request->input('id');
        $var->case_no = $request->input('case_no');
        $var->description = $request->input('description');
        $var->remind_date = $request->input('reminddate');
        $var->type = $request->input('type');
        $var->save();
        return redirect('/admin/reminder');
    }

    public function deleteAdmin(Request $request,$id){
        $user = CustomUser::find($id);
        $user->delete();
        return redirect('/admin');
    }
    public function deleteCase(Request $request,$id){
        $case = CaseTable::find($id);
        $case->delete();
        return redirect('/admin/cases');
    }
    public function deleteClient(Request $request,$id){
        $client = Client::find($id);
        $client->delete();
        return redirect('/admin/clients');
    }
    public function deleteDoc(Request $request,$id){
        $doc = Doc::find($id);
        $doc->delete();
        return redirect('/admin/docs');
    }
    public function deleteReminder(Request $request,$id){
        $doc = Reminder::find($id);
        $doc->delete();
        return redirect('/admin/reminder');
    }

    //mail
    public function emailSend()
    {
        $name = 'Hatim';
        Mail::to('hatim.nalawala987@gmail.com')->send(new SendMailable($name));
        return 'Email was sent';
    }

    //search lawbook
    public function searchLawbook(Request $request){
        $q = $request->input('searchTerm');
        $laws = Directory::where('penal_code','LIKE','%'.$q.'%')->get();
        if(count($laws) > 0)
            return view('pages.lawbook')->with('laws',$laws)->withQuery ( $q );
        else{
            $laws = Directory::where('name','LIKE','%'.$q.'%')->orWhere('detail','LIKE','%'.$q.'%')->get();
            if(count($laws) > 0)
                return view('pages.lawbook')->with('laws',$laws)->withQuery ( $q );
            else 
                return view ('pages.lawbook')->withMessage('No Details found. Try to search again !');
        }

}

    //profile
    public function updateprofile(Request $request,$id){
        $pro = LawyerProfile::where('user_id',$id)->get();
            foreach($pro->all() as $p){
            $p->delete();
            }
            $profile = new LawyerProfile;
            $profile->user_id = $id;
            $profile->city=$request->input('city');
            $profile->name = $request->input('name');
            $profile->office_address=$request->input('office_address');
            $profile->office_phone=$request->input('office_phone');
            $profile->achievements=$request->input('achievements');
            $profile->mobile_phone=$request->input('mobile');
            $profile->long_description=$request->input('description');
            $profile->gender=$request->input('gender');
            $profile->birth_date=$request->input('birthdate');
            $profile->website=$request->input('website');
            $areas = $request->input('practice');
            $str ="";
            foreach($areas as $area){
                $str=$str.$area . "\n";
            }
            $profile->area=$str;
            $profile->save();
        
        return redirect('/profile');
   }

   public function requestAppointment(Request $request,$id){
            $var = new Appointment;
           $var->user_id = auth()->user()->id;
           $var->title = $request->input('title');
           $var->type = 'first';
           $var->lawyer_id = $request->input('lawyer_id');
           $var->lawyer_name = $request->input('name');
           $var->description = $request->input('description');
           $var->date = $request->input('date');
           $var->save();
           return redirect('/dashboard');
}

    public function searchLawyersCategory(Request $request){
        $category = $request->input('category');
        foreach($category as $c){
            $ce = $c;
        }
        $profiles = LawyerProfile::where('area','LIKE','%' . $ce . '%')->get();
        
        return view('pages.searchLawyers')->with('profiles',$profiles);
    }

    public function searchLawyers(Request $request){
        $search = $request->input('searchTerm');
        
        $profiles = LawyerProfile::where('area','LIKE','%' . $search . '%')->orWhere('name','LIKE','%' . $search . '%')->orWhere('city','LIKE','%' . $search . '%')->get();
        
        return view('pages.searchLawyers')->with('profiles',$profiles);
    }

    //Search
    public function searchCases(Request $request){
        $user = auth()->user();
        $userType = $user->type;
        $user_id = $user->id;
        $search = $request->input('search');
        if(strcmp($userType,"lawyer")==0)
            $case_info = CaseTable::where('lawyer_id',$user_id)->where('case_no','LIKE','%' . $search . '%')->orWhere('description','LIKE','%' . $search . '%')->orWhere('category','LIKE','%' . $search . '%')->get();
        else
        $case_info = CaseTable::where('client_id',$user_id)->where('case_no','LIKE','%' . $search . '%')->orWhere('description','LIKE','%' . $search . '%')->orWhere('category','LIKE','%' . $search . '%')->get();
        return view('pages.cases')->with('case_info',$case_info);
    }
    public function searchClients(Request $request){
        $user = auth()->user();
        $userType = $user->type;
        $user_id = $user->id;
        $search = $request->input('search');
        $client = Client::where('lawyer_id',$user_id)->where('client_name','LIKE','%' . $search . '%')->orWhere('case_id','LIKE','%' . $search . '%')->get();
        return view('pages.clients')->with('client',$client);
    }
    public function searchCLawyers(Request $request){
        $user = auth()->user();
        $userType = $user->type;
        $user_id = $user->id;
        $search = $request->input('search');
        $lawyers = Client::where('client_id',$user_id)->where('client_name','LIKE','%' . $search . '%')->orWhere('case_id','LIKE','%' . $search . '%')->get();
        return view('pages.lawyers')->with('lawyers',$lawyers);
    }

    //update
    public function updateStatus(Request $request,$id){
        $case = CaseTable::find($id);
        $case->court_number = $request->input('court_number');
        $case->judge_name = $request->input('judge_name');
        $case->status = $request->input('status');
        $case->save();
        return redirect()->back();
    }

    public function updateActs(Request $request,$id){
        $case = CaseTable::find($id);
        $case->penal_code = $request->input('penal_code');
        
        $case->save();
        return redirect()->back();
    }
    public function updatePetitioner(Request $request,$id){
        $case = CaseTable::find($id);
        $case->petitioner = $request->input('petitioner');
        
        $case->save();
        return redirect()->back();
    }
    public function updateRespondent(Request $request,$id){
        $case = CaseTable::find($id);
        $case->respondent = $request->input('respondent');
        
        $case->save();
        return redirect()->back();
    }

    public function addHearing(Request $request,$id){
        $case = CaseTable::find($id);
       $hearing = new Hearing;
       $hearing->case_id=$case->case_no;
       $hearing->judge_name = $request->input('judge_name');
       $hearing->description = $request->input('description');
       $hearing->judgement = $request->input('judgement');
       $hearing->starting_date = $request->input('starting_date');
       $hearing->ending_date = $request->input('ending_date');
       $hearing->next_hearing_date = $request->input('next_hearing_date');
       $hearing->comments = $request->input('comments');
       $hearing->save();
        return redirect()->back();
    }

}