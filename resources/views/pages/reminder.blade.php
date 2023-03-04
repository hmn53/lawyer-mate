@extends('layouts/app')
  <?php
  $user = auth()->user();
  $user_id = $user->id;
  $userType = $user->type;
  if(strcmp($userType,"lawyer")==0){
    $case_info = DB::table('case_table')->select('case_no')->where('lawyer_id',$user_id)->get();
  }else{
    $case_info = DB::table('case_table')->select('case_no')->where('client_id',$user_id)->get();
  }
  $result1 = json_decode($case_info, true);
?>
@section('content')
<main class="page contact-us-page">
    <section class="clean-block clean-form dark">
    <div class="container">
      <div class="block-heading">
        <h2 class="text-info">Add Reminder</h2>
    </div>
    <form action="/reminder" method="POST">
        @csrf
          <div class="form-group ">
            <label for="type" class=" col-form-label">Type</label>
                <select class="form-control" id="type" name="type">
                    <option>Appointment</option>
                    <option>Hearing</option>
                </select>
          </div>
          <div class="form-group ">
              <label for="description" class=" col-form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
          </div> 
            <div class="form-group ">
                <label for="case_no" class=" col-form-label">Case Number</label>
              
                <select class="form-control" id="case_no" name="case_no">
                    @foreach ($result1 as $case)
                    <option>{{$case['case_no']}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ">
              <label for="reminddate" class=" col-form-label">Remind Date</label>
              
                <input type="date" class="form-control" id="reminddate" name="reminddate">
              
            </div>
          <div class="form-group ">
            
              <button type="submit" class="btn btn-primary">Submit</button>
            
          </div>
        </form>
   
  </div>
  </section>
  </main>
  @endsection
