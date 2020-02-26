@extends('layouts/app')
  <?php
  use App\CaseTable;
  use App\Client;
  use App\CustomUser;
  $user = auth()->user();
  $user_id = $user->id;
  $userType = $user->type;
    $clientnames= DB::table('client_table')->select('client_name')->where('lawyer_id',$user_id)->get();
    $result1 = json_decode($clientnames, true);
?>
<?php
  if(strcmp($userType,"lawyer")==0){
    $case_info = DB::table('case_table')->select('*')->where('lawyer_id',$user_id)->get();
    //$clients_name = DB::table('client_table')->select('client_name')->where('lawyer_id',$user_id)->get();
    $result = json_decode($case_info, true);
  }else{
    $case_info = CaseTable::where('client_id',$user_id)->get();
    $result = json_decode($case_info, true);
  }
 
  $count=0;
?>
@section('content')

<div class="modal fade" id="descModal" role="dialog">
  <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Description</h4>
          </div>
          <div class="modal-body">
                Hi
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" role="dialog" id="myModal">
  <div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title">Add Case</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    
  </div>
  <div class="modal-body">
  <section class="clean-block clean-form dark">
 
      <form action="/cases/add" method="POST">
        @csrf
          <div class="form-group ">
            <label for="caseno" class=" col-form-label">Case Number</label>
            
              <input type="text" class="form-control" id="caseno" name="caseno" placeholder="Case Number">
            
          </div>
          <div class="form-group ">
              <label for="clientname" class=" col-form-label">Client Name</label>
              
                  <select class="form-control" id="clientname" name="clientname">
                      @foreach ($result1 as $name)
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
  </section>
  </div>
</div>
</div>
</div>
<div id="content" style="margin-top:190px">
  <div class="container">
    <div class="card-header py-3" style="background-color:#D0D3D4;">
      @if (strcmp($userType,"lawyer")==0)
      <p class="text-primary m-0 font-weight-bold">Cases <span style="margin-bottom:5px;padding:0;justify-content:center" class="float-right"><button class="btn btn-primary"style="margin:0;padding:0"data-toggle="modal" data-target="#myModal"><a style="margin:0;padding:0 20px 0 20px" class="btn btn-primary" type="button">Add</a></button></span></p>
      @else
      <p class="text-primary m-0 font-weight-bold">Cases </p>
      @endif
      
      
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
                            <th>Case Number</th>
                            @if (strcmp($userType,"lawyer")==0)
                              <th>Client Name</th>
                            @else
                              <th>Lawyer Name</th>
                            @endif
                            
                            <th>Description</th>
                            <th>Case Category</th>
                            <th>Case Status</th>
                            <th>Date of Filing</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                          @foreach ($result as $info)
                          
                          <td>{{$info['case_no']}} </td>
                          @if (strcmp($userType,"lawyer")==0)
                            <?php $client_name = DB::table('client_table')->select('client_name')->where('client_id',$info['client_id'])->get();
                            $name = json_decode($client_name,true); ?>
                            @foreach ($name as $item)
                              <td>{{$item['client_name']}} </td>
                            @endforeach
                         
                          @else
                            <?php $lawyer_name = CustomUser::select('name')->where('id',$info['lawyer_id'])->get();
                              ?>
                            @foreach ($lawyer_name->all() as $item)
                              <td>{{$item['name']}} </td>
                              
                            @endforeach
                          @endif
                         
                          <td><a href="/cases/show/{{$info['id']}}">{{$info['description']}} </a></td>
                          <td>{{$info['category']}} </td>
                          <td>{{$info['status']}} </td>
                          <td>{{$info['date_of_filing']}}</td>
                          <?php $count+=1; ?>
                          
                      @endforeach
                        </tr>
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
