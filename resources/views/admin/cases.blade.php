<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin</title>

    {{-- <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .container{margin-top: 50px;}
        body{
            background-image: url("/public/images/photo.jpg");
        }
</style>    --}}
    {{-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap-notifications.min.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/bootstrap2.min.css')}}"> --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="{{asset('css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/material-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/fontawesome5-overrides.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="{{asset('css/smoothproducts.css')}}">
    <link rel="stylesheet" href="{{asset('css/notification.css')}}">
    
</head>   
<body>
    <?php
    $user_id = auth()->user()->id;
    $case = DB::table('case_table')->select('*')->get();
    $result = json_decode($case, true);
    $count=0;
    ?>
        @include('includes/adminpanel')
        <div class="modal fade" role="dialog" id="myModal">
            <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Case</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              
            </div>
            <div class="modal-body">
            <section class="clean-block clean-form dark">
           
                <form action="/admin/add/case" method="POST">
                  @csrf
                    <div class="form-group ">
                      <label for="caseno" class=" col-form-label">Case Number</label>
                      
                        <input type="text" class="form-control" id="caseno" name="caseno" placeholder="Case Number">
                      
                    </div>
                    <div class="form-group ">
                        <label for="clientid" class=" col-form-label">Client ID</label>
                        
                          <input type="text" class="form-control" id="clientid" name="clientid" placeholder="Client ID">
                        
                      </div>
                      <div class="form-group ">
                        <label for="lawyerid" class=" col-form-label">Lawyer ID</label>
                        
                          <input type="text" class="form-control" id="lawyerid" name="lawyerid" placeholder="Lawyer ID">
                        
                      </div>
                    <div class="form-group ">
                        <label for="clientname" class=" col-form-label">Client Name</label>
                        
                        <input type="text" class="form-control" id="clientname" name="clientname" placeholder="Client Name">
                        
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
            </section>
            </div>
          </div>
          </div>
          </div>
        <div id="content" style="margin-top:100px">
            <div class="container">
              <div class="card-header py-3" style="background-color:#D0D3D4 ">
                <p class="text-primary m-0 font-weight-bold">Cases <span style="margin-bottom:5px;padding:0;justify-content:center" class="float-right"><button class="btn btn-primary"style="margin:0;padding:0"data-toggle="modal" data-target="#myModal"><a style="margin:0;padding:0 20px 0 20px" class="btn btn-primary" type="button">Add</a></button></span></p>
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
                              
                              <th>Case No</th>
                              <th>Client ID</th>
                              <th>Lawyer ID</th>
                              <th>Judge Name</th>
                              <th>Court type</th>
                              <th>Category</th>
                              <th>Status</th>                    
                              <th>Date of filing</th>
                              <th>Desciption</th>
                          </tr>
                      </thead>
                      <tbody> 
                        @foreach ($result as $info)
                        <tr>
                          <td>{{$info['case_no']}}</td>
                          <td>{{$info['client_id']}}</td> 
                          <td>{{$info['lawyer_id']}}</td>
                          <td>{{$info['judge_name']}}</td>
                          <td>{{$info['court_type']}}</td>
                          <td>{{$info['category']}}</td>
                          <td>{{$info['status']}}</td>
                          <td>{{$info['date_of_filing']}}</td>
                          <td>{{$info['description']}}</td>
                          <td>{!! Form::open(['action'=>['PagesController@deleteCase',$info['id']],'method'=>'POST','class'=>'pull-right']) !!}
                            {{-- {!! Form::hidden('_method', 'DELETE') !!}      --}}
                            {!! Form::submit('✖', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}</td>
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
            
        
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="{{asset('js/smoothproducts.min.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>
  
    
</body>
</html>






