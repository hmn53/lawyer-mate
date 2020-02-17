<?php 
    use App\CaseTable;
    use App\Client;
    use App\Doc;
    use App\Reminder;
    $user = auth()->user();
    $userId = $user->id;
    $casesId = CaseTable::select('case_no')->where('lawyer_id',$userId)->get();
    $caseCount = CaseTable::where('lawyer_id',$userId)->count();
    $clientCount = Client::where('lawyer_id',$userId)->count();
    $docCount = 0;
    $reminderCount = Reminder::where('user_id',$userId)->count();
    foreach ($casesId as $caseId) {
      $docCount += Doc::where('case_id',$caseId->case_no)->count();
    }
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
                    <div class="card-body">
                      <p class="card-title text-md-center text-xl-left">Cases</p>
                      <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$caseCount}}</h3>
                        <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                      </div>  
                      {{-- <p class="mb-0 mt-2 text-danger">0.12% <span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
                    </div>
                  </div>
                </div>
                <div class="col-md-3 ">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title text-md-center text-xl-left">Clients</p>
                      <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$clientCount}}</h3>
                        <i class="ti-user icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                      </div>  
                      {{-- <p class="mb-0 mt-2 text-danger">0.47% <span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
                    </div>
                  </div>
                </div>
                <div class="col-md-3 ">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title text-md-center text-xl-left">Documents</p>
                      <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                        <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$docCount}}</h3>
                        <i class="ti-agenda icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                      </div>  
                      {{-- <p class="mb-0 mt-2 text-success">64.00%<span class="text-black ml-1"><small>(30 days)</small></span></p> --}}
                    </div>
                  </div>
                </div>
                <div class="col-md-3 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="card-title text-md-center text-xl-left">Reminders</p>
                      <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
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
          <div class="row">
            <div class="col-md-6  ">
              <div class="card">
                <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                  <p class="card-title">Sales details</p>
                  <p class="text-muted font-weight-light">Received overcame oh sensible so at an. Formed do change merely to county it. Am separate contempt domestic to to oh. On relation my so addition branched.</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"><ul class="1-legend"><li><span style="background-color:#8EB0FF"></span>Offline Sales</li><li><span style="background-color:#316FFF"></span>Online Sales</li></ul></div>
                  <canvas id="sales-chart" width="675" height="337" class="chartjs-render-monitor" style="display: block; height: 270px; width: 540px;"></canvas>
                </div>
                <div class="card border-right-0 border-left-0 border-bottom-0">
                  <div class="d-flex justify-content-center justify-content-md-end">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-lg btn-outline-light dropdown-toggle rounded-0 border-top-0 border-bottom-0" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Today
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">January - March</a>
                        <a class="dropdown-item" href="#">March - June</a>
                        <a class="dropdown-item" href="#">June - August</a>
                        <a class="dropdown-item" href="#">August - November</a>
                      </div>
                    </div>
                    <button class="btn btn-lg btn-outline-light text-primary rounded-0 border-0 d-none d-md-block" type="button"> View all </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6  ">
              <div class="card border-bottom-0"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                <div class="card-body pb-0">
                  <p class="card-title">Purchases</p>
                  <p class="text-muted font-weight-light">The argument in favor of using filler text goes something like this: If you use real content in the design process, anytime you reach a review</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Status</p>
                      <h3>362</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">New users</p>
                      <h3>187</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Chats</p>
                      <h3>524</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Feedbacks</p>
                      <h3>509</h3>
                    </div> 
                  </div>
                </div>
                
              </div>
            </div>
          </div>
      </div>
  </section>
</main>