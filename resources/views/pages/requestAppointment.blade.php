@extends('layouts/app')
  <?php
use App\Client;
use App\CustomUser;
  $user = auth()->user();

  $user_id = $user->id;
    $lawyer = CustomUser::find($id);
  
?>
@section('content') 
<main class="page contact-us-page">
    <section class="clean-block clean-form dark">
    <div class="container">
      <div class="block-heading">
        <h2 class="text-info">Set Appointment</h2>
    </div>
    <form action="/request/appointment/{{$id}}" method="POST">
        @csrf
        <div class="form-group ">
            <label for="name" class=" col-form-label">Lawyer Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$lawyer->name}}" readonly>
          </div>
          <div class="form-group ">
            <label for="title" class=" col-form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
          </div>
          <div class="form-group ">
              <label for="description" class=" col-form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
          </div>
            
            <div class="form-group ">
              <label for="date" class=" col-form-label">Date</label>

                <input type="date" class="form-control" id="date" name="date">

            </div>
            <input type="hidden" id="lawyer_id" name="lawyer_id" value="{{$id}}">
          <div class="form-group ">

              <button type="submit" class="btn btn-primary">Submit</button>

          </div>
        </form>

  </div>
  </section>
  </main>
  @endsection
