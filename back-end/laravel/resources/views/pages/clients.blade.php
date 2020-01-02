<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Portal for Lawyers</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap2.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="{{asset('css/smoothproducts.css')}}">
</head>
<body>
  @include('includes/newnavbar')
<?php
  $user_id = auth()->user()->id;
  $client = DB::table('clients_table')->select('*')->where('lawyer_id',$user_id)->get();
  $result = json_decode($client, true);
  $count=0;
?>
{{-- <div class="container">
    <div class="jumbotron">
        <table class="table" style="text-align: center">
            <thead>
              <tr>
                <th scope="col">Client Name</th>
                <th scope="col">Case Number</th>
              </tr>
            </thead>
            <tbody>
              
                @foreach ($result as $info)
                <tr>
                  <td>{{$info['client_name']}}</td>
                  @if ($info['case_id']=="")
                    <td>null</td>
                  @else
                    <td>{{$info['case_id']}}</td>
                  @endif
                </tr>
                @endforeach
              
            </tbody>
          </table>
    </div>
</div> --}}
<div id="content" style="margin-top:100px">
  <div class="container">
    <div class="card-header py-3" style="background-color:#D0D3D4 ">
      <p class="text-primary m-0 font-weight-bold">Clients</p>
  </div>
  <div class="card-body" style="background-color:#ECF0F1">
    <div class="row">
        <div class="col-md-6 text-nowrap">
            <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
        </div>
        <div class="col-md-6">
            <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
        </div>
    </div>
    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
        <table class="table dataTable my-0" id="dataTable">
            <thead>
                <tr>
                    
                    <th>Client Name</th>
                    <th>Case Number</th>
                    
                </tr>
            </thead>
            <tbody> 
              @foreach ($result as $info)
              <tr>
                <td>{{$info['client_name']}}</td>
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
            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing {{$count}} to 10 </p>
        </div>
        
    </div>
</div>

</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="{{asset('js/smoothproducts.min.js')}}"></script>
<script src="{{asset('js/theme.js')}}"></script>
</body>

</html>

