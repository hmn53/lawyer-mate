<?php
use App\CaseTable;
use App\Client;
use App\Doc;
use App\Reminder;
use App\Appointment;
use App\CustomUser;
$user = auth()->user();
$userId = $user->id;
$casesId = CaseTable::select('case_no')->where('lawyer_id',$userId)->get();
$caseCount = CaseTable::where('lawyer_id',$userId)->count();
$clientCount = Client::where('lawyer_id',$userId)->count();
$docCount = 0;
$reminderCount = Reminder::where('user_id',$userId)->count();
$reminders = Reminder::where('remind_date','>=',date('Y-d-m'))->where('user_id',$userId)->get();
$clientsId = Client::select('client_id')->where('lawyer_id',$userId)->get();
foreach ($casesId as $caseId) {
$docCount += Doc::where('case_id',$caseId->case_no)->count();
}
$appointments = Appointment::where('lawyer_name',$user->name)->get();
?>
<main class="page service-page" >
  <section class="clean-block clean-services dark" >
    <div class="container" >
      <div class="block-heading">
        <h2 class="text-info">Dashboard</h2>
      </div>
      <div class="row">
        <div class="col-md-3 ">
          <div class="card">
            <div class="card-body" style="text-align:center !important">
              <p class="card-title text-md-center" style="font-size:16px" >Cases</p>
              <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$caseCount}}</h3>
                <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
              </div>
              {{-- <p class="mb-0 mt-2 text-danger">0.12% <span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
            </div>
          </div>
        </div>
        <div class="col-md-3 ">
          <div class="card">
            <div class="card-body"style="text-align:center !important">
              <p class="card-title text-md-center" style="font-size:16px">Clients</p>
              <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$clientCount}}</h3>
                <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
              </div>
              {{-- <p class="mb-0 mt-2 text-danger">0.47% <span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
            </div>
          </div>
        </div>
        <div class="col-md-3 ">
          <div class="card">
            <div class="card-body"style="text-align:center !important">
              <p class="card-title " style="font-size:16px">Documents</p>
              <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$docCount}}</h3>
                <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
              </div>
              {{-- <p class="mb-0 mt-2 text-success">64.00%<span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body"style="text-align:center !important" >
              <p class="card-title text-md-center "style="font-size:16px">Reminders</p>
              <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$reminderCount}}</h3>
                <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
              </div>
              {{-- <p class="mb-0 mt-2 text-success">23.00%<span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
            </div>
          </div>
        </div>
        {{-- <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Case Requests</h4><i class="fa fa-briefcase" style="font-size: 30px;margin: 10px 0 30px 0 ;"></i>
              <p class="card-text">View all case related clients' requests.</p>
            </div>
            <div><a class="btn btn-outline-primary margin-a"href="/inbox" type="button">View</a></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Important Docs</h4><i class="material-icons" style="font-size: 30px;margin: 10px 0 30px 0 ;">find_in_page</i>
              <p class="card-text">View all the documents.</p>
            </div>
            <div><a class="btn btn-outline-primary margin-a" href="/docs" type="button">View</a></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Lawbook</h4><i class="fa fa-book" style="font-size: 30px;margin: 10px 0 30px 0 ;"></i>
              <p class="card-text">Read Lawbook here.</p>
            </div>
            <div><a class="btn btn-outline-primary margin-a" href="/lawbook">View</a></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">History</h4><i class="material-icons" style="font-size: 30px;margin: 10px 0 30px 0 ;">message</i>
              <p class="card-text">History of previous cases.</p>
            </div>
            <div><a class="btn btn-outline-primary margin-a" href="/cases"type="button">View</a></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Current Case</h4><i class="fa fa-briefcase" style="font-size: 30px;margin: 10px 0 30px 0 ;"></i>
              <p class="card-text">Go to the current case.</p>
            </div>
            <div><a class="btn btn-outline-primary margin-a" href="/cases" type="button">View</a></div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="card"></div>
        </div>
      </div> --}}
      
        <div class="col-sm-6">
          <div class="card" style="height:auto;">
            <div class="card-header" style="font-size:22px">Upcoming Reminders</div>
            <div class="card-body" style="text-align:justify;">

              <div class="card-text">
                @if(count($reminders)==0)
                  <p style="text-align:center"><em>No Reminder Found!</em><p>
                @endif
                @foreach ($reminders->all() as $item)
                <?php
                  $case = CaseTable::where('case_no',$item->case_no)->get();
                  foreach ($case->all() as $i) {
                    $client = CustomUser::find($i['client_id']);
                  }
                  $clientName = $client->name;
                ?>
                <div class="row">                  
                  <div class="col-md-10 product-info" style="margin-left:30px">{{$item['description']}}                
                  <div class="product-specs" style="font-size:0.85em; text-align:justify;">
                  <div><span>Client :&nbsp;</span><span class="value">{{$clientName}}</span></div>
                  <div><span>Case :&nbsp;</span><span class="value">{{$item['case_no']}}</span></div>
                  <div><span>Date:&nbsp;</span><span class="value">{{$item['remind_date']}}</span></div>
                  
                  </div>
                  </div>
                </div>
                @if (count($reminders)>1)
                  <hr>
                @endif
                @endforeach
                
              </div>
              
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card" style="height:auto;">
            <div class="card-header" style="font-size:22px">Upcoming Appointments</div>
            <div class="card-body" style="text-align:justify;">
             
              <div class="card-text">
                @if(count($appointments)==0)
                <p style="text-align:center"><em>No Appointments!</em><p>
                @endif
                @foreach ($appointments as $item)
                @if (strcmp($item['accepted'],"rejected")!=0)
                <?php 
                  $client = CustomUser::find($item->user_id);
                  $clientName = $client->name;
                ?>
                <div class="row">
                  @if (strcmp($item['accepted'],"pending")==0)
                    <div class="col-md-10 product-info" style="margin-left:30px">{{$item['title']}}
                  @endif
                  @if (strcmp($item['accepted'],"accepted")==0)
                    <div class="col-md-10 product-info" style="margin-left:30px ; color:limegreen">{{$item['title']}} 
                  @endif
                  
                  <div class="product-specs" style="font-size:0.85em; color:black">
                  <div><span>Description :&nbsp;</span><span class="value">{{$item['description']}}</span></div>
                  <div><span>Client :&nbsp;</span><span class="value">{{$clientName}}</span></div>
                  <div><span>Date:&nbsp;</span><span class="value">{{$item['date']}}</span></div>
                  @if (strcmp($item['accepted'],"pending")==0)
                  <a href="/appointment/accept/{{$item['id']}}" style="color: rgb(0,123,255);"><button class="btn btn-success btn-sm">	✓ </button></a>
                  <a href="/appointment/unaccept/{{$item['id']}}" style="color: rgb(0,123,255);"><button class="btn btn-danger btn-sm">	✕ </button></a>
                  @endif
                
                  </div>
                  </div>
                </div>
                  @if (count($appointments)>1)
                    <hr>
                  @endif
                @endif
                @endforeach
                
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
