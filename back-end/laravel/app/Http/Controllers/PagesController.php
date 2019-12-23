<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function lawbook(){
        return view('pages/lawbook');
    }

    public function index(){
        return view('pages/index');
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

    public function store(Request $request){
        $request->validate([
            'caseno' => 'required',
            'description' => 'required',
        ]);
        return redirect('/');
        
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
