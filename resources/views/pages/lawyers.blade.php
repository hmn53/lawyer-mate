@extends('layouts/app')
<?php
    use App\Client;
  $user_id = auth()->user()->id;
  if(!isset($lawyers))
      $lawyers = Client::where('client_id',$user_id)->get();
  $result = json_decode($lawyers, true);
  $count=0;
?>
@section('content')

<div id="content" style="margin-top:190px">
  <div class="container">
    <div class="card-header py-3" style="background-color:#D0D3D4 ">
      <p class="text-primary m-0 font-weight-bold">Lawyers</p>
  </div>
  <div class="card-body" style="background-color:#ECF0F1">
    <div class="row">
        <div class="col-md-6 text-nowrap">
            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right dataTables_filter" id="dataTable_filter"><form action="/search/clients" method="POST">@csrf<label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" name="search" placeholder="Search"></label>&nbsp;<button type="submit" class="btn btn-primary btn-sm">Submit</button></form></div>
        </div>
    </div>
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table dataTable my-0" id="dataTable">
            <thead>
                <tr>
                    
                    <th>Lawyer Name</th>
                    <th>Case Number</th>
                    
                </tr>
            </thead>
            <tbody> 
              @foreach ($result as $info)
              <tr>
                <td>{{$info['lawyer_name']}}</td>
                @if ($info['case_id']=="")
                  <td>null</td>
                @else
                  <td>{{$info['case_id']}}</td>
                @endif
                
              </tr>
              <?php 
                $count+=1;
              ?>
              @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-6 align-self-center">
            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing {{$count}} of {{$count}} </p>
        </div>
        
    </div>
</div>

</div>
</div>

@endsection

