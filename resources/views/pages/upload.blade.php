@extends('layouts/app')

@section('content')
<?php
    $user = auth()->user();
    $user_id = $user->id;
    $type =$user->type;
    if($type =="lawyer"){
        $caseno=DB::table('case_table')->select('case_no')->where('lawyer_id',$user_id)->get();
    }else {
        $caseno=DB::table('case_table')->select('case_no')->where('client_id',$user_id)->get();
    }
    $result = json_decode($caseno, true);
    
    

?>
<main class="page contact-us-page">
  <section class="clean-block clean-form dark">
  <div class="container">
    <div class="block-heading">
      <h2 class="text-info">Upload Docs</h2>
  </div>
        <form action="/docs/upload" method="POST" enctype="multipart/form-data">
          @csrf
            <div class="form-group ">
              <label for="docname" class=" col-form-label">Document Name</label>
              
                <input type="text" class="form-control" id="docname" name="docname" placeholder="Document Name">
              
            </div>
            <div class="form-group ">
                <label for="caseno" class=" col-form-label">Case Number</label>
                
                    <select class="form-control" id="caseno" name="caseno">
                        @foreach ($result as $case)
                        <option>{{$case['case_no']}}</option>
                        @endforeach
                    </select>
                
            </div> 
            <div class="form-group ">
                <label for="description" class=" col-form-label">Description</label>
                
                    <textarea class="form-control" id="description" name="description"></textarea>
                
              </div>
              <div class="form-group">
                    <input type="file" name="doc">
              </div>
            <div class="form-group ">
              
                <button type="submit" class="btn btn-primary">Submit</button>
              
            </div>
          </form>
    
</div>
</section>
</main>
@endsection