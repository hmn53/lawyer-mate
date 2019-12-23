@extends('layouts/app')

@section('content')
<?php
    $user_id = auth()->user()->id;
    $clientnames= DB::table('client_table')->select('client_name')->where('lawyer_id',$user_id)->get();
    $result = json_decode($clientnames, true);
?>
<div class="container">
    <div class="jumbotron">
        <form action="PagesController@store" method="POST">
            <div class="form-group row">
              <label for="caseno" class="col-sm-2 col-form-label">Case Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="caseno" name="caseno" placeholder="Case Number">
              </div>
            </div>
            <div class="form-group row">
                <label for="clientname" class="col-sm-2 col-form-label">Client Name</label>
                <div class="col-sm-10">
                    <select class="form-control" id="clientname" name="clientname">
                        @foreach ($result as $name)
                        <option>{{$name['client_name']}} </option>
                        @endforeach
                    </select>
                </div>
            </div> 
              <div class="form-group row">
                <label for="judgename" class="col-sm-2 col-form-label">Judge Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="judgename" name="judgename" placeholder="Judge Name">
                </div>
              </div>
              <div class="form-group row">
                <label for="courttype" class="col-sm-2 col-form-label">Court Type</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="courttype" name="courttype" placeholder="Court Type">
                </div>
              </div>
              <div class="form-group row">
                <label for="category" class="col-sm-2 col-form-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-control" id="category" name="category">
                        <option>Civil</option>
                        <option>Criminal</option>
                        <option>Intellectual Property</option>
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="casemembers" class="col-sm-2 col-form-label">Case Members</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="casemembers" name="casemembers" placeholder="Case Members">
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Case Status</label>
                <div class="col-sm-10">
                    <select class="form-control" id="status" name="status">
                        <option>Pending</option>
                        <option>In Progress</option>
                        <option>Closed</option>
                        <option>Cancelled</option>
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="filingdate" class="col-sm-2 col-form-label">Filing Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="filingdate" name="filingdate">
                </div>
              </div>
              <div class="form-group row">
                <label for="opponent" class="col-sm-2 col-form-label">Opponent Details</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="opponent" name="opponent" rows="2"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="summary" class="col-sm-2 col-form-label">Summary</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="summary" name="summary" rows="2"></textarea>
                </div>
              </div>
             
              <div class="form-group row">
                <label for="background" class="col-sm-2 col-form-label">Background</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="background" name="background" rows="2"></textarea>
                </div>
              </div>
            <div class="form-group row">
              <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
          </form>
    </div>
</div>
@endsection