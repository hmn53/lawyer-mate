@extends('layouts/app')

@section('content')
<?php
    $user_id = auth()->user()->id;
    $clientnames= DB::table('client_table')->select('client_name')->where('lawyer_id',$user_id)->get();
    $result = json_decode($clientnames, true);
?>
<main class="page contact-us-page">
  <section class="clean-block clean-form dark">
  <div class="container">
    <div class="block-heading">
      <h2 class="text-info">Add Case</h2>
  </div>
        <form action="/cases/add" method="POST">
          @csrf
            <div class="form-group ">
              <label for="caseno" class=" col-form-label">Case Number</label>
              
                <input type="text" class="form-control" id="caseno" name="caseno" placeholder="Case Number">
              
            </div>
            <div class="form-group ">
                <label for="clientname" class=" col-form-label">Client Name</label>
                
                    <select class="form-control" id="clientname" name="clientname">
                        @foreach ($result as $name)
                        <option>{{$name['client_name']}} </option>
                        @endforeach
                    </select>
                
            </div> 
              <div class="form-group ">
                <label for="judgename" class=" col-form-label">Judge Name</label>
                
                  <input type="text" class="form-control" id="judgename" name="judgename" placeholder="Judge Name">
                
              </div>
              <div class="form-group ">
                <label for="courttype" class=" col-form-label">Court Type</label>
                
                  <input type="text" class="form-control" id="courttype" name="courttype" placeholder="Court Type">
                
              </div>
              <div class="form-group ">
                <label for="category" class=" col-form-label">Category</label>
                
                    <select class="form-control" id="category" name="category">
                        <option>Civil</option>
                        <option>Criminal</option>
                        <option>Intellectual Property</option>
                    </select>
                
              </div>
              <div class="form-group ">
                <label for="casemembers" class=" col-form-label">Case Members</label>
                
                  <input type="number" class="form-control" id="casemembers" name="casemembers" placeholder="Case Members">
                
              </div>
              <div class="form-group ">
                <label for="status" class=" col-form-label">Case Status</label>
                
                    <select class="form-control" id="status" name="status">
                        <option>Pending</option>
                        <option>In Progress</option>
                        <option>Closed</option>
                        <option>Cancelled</option>
                    </select>
                
              </div>
              <div class="form-group ">
                <label for="filingdate" class=" col-form-label">Filing Date</label>
                
                  <input type="date" class="form-control" id="filingdate" name="filingdate">
                
              </div>
              <div class="form-group ">
                <label for="opponent" class=" col-form-label">Opponent Details</label>
                
                    <textarea class="form-control" id="opponent" name="opponent" ></textarea>
                
              </div>
              <div class="form-group ">
                <label for="description" class=" col-form-label">Description</label>
                
                    <textarea class="form-control" id="description" name="description"></textarea>
                
              </div>
              <div class="form-group ">
                <label for="summary" class=" col-form-label">Summary</label>
                
                    <textarea class="form-control" id="summary" name="summary" ></textarea>
                
              </div>
             
              <div class="form-group ">
                <label for="background" class=" col-form-label">Background</label>
                
                    <textarea class="form-control" id="background" name="background" ></textarea>
                
              </div>
            <div class="form-group ">
              
                <button type="submit" class="btn btn-primary">Submit</button>
              
            </div>
          </form>
    
</div>
</section>
</main>
@endsection