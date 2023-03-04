@extends('layouts/app')
  <?php
use App\Client;
  $user = auth()->user();

  $user_id = $user->id;
  $userType = $user->type;
  if(strcmp($userType,"lawyer")==0){
    redirect('/reminder');
  }else{
    $lawyer=Client::select('lawyer_name')->where('client_id',$user_id)->get();
  }
  $result1 = json_decode($lawyer, true);
?>
@section('content')
<main class="page contact-us-page">
    <section class="clean-block clean-form dark">
    <div class="container">
      <div class="block-heading">
        <h2 class="text-info">Set Appointment</h2>
    </div>
    <form action="/appointment" method="POST">
        @csrf
          {{-- <div class="form-group ">
            <label for="type" class=" col-form-label">Type</label>
                <select class="form-control" id="type" name="type">
                    <option>Appointment</option>
                    <option>Hearing</option>
                </select>
          </div> --}}
          <div class="form-group ">
            <label for="title" class=" col-form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="form-group ">
              <label for="description" class=" col-form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
          </div>
            <div class="form-group ">
                <label for="lawyer_name" class=" col-form-label">Lawyer Name</label>

                <select class="form-control" id="lawyer_name" name="lawyer_name">
                    @foreach ($result1 as $lawyer)
                    <option>{{$lawyer['lawyer_name']}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ">
              <label for="date" class=" col-form-label">Date</label>

                <input type="date" class="form-control" id="date" name="date">

            </div>
            @if (isset($type))
              <input type="hidden" id="type" name="type" value="{{$type}}">
            @endif
            
          <div class="form-group ">

              <button type="submit" class="btn btn-primary">Submit</button>

          </div>
        </form>

  </div>
  </section>
  </main>
  @endsection
