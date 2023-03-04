<?php
    use App\CaseTable;
    use App\Client;
    use App\Doc;
    use App\Reminder;
    use App\Appointment;
    use App\CustomUser;
    use App\Hearing;
    $user = auth()->user();
    $userId = $user->id;
    $cases = CaseTable::where('client_id',$userId)->get();
    $caseCount = CaseTable::where('client_id',$userId)->count();
    $clientCount = Client::where('client_id',$userId)->count();
    $docCount = Doc::where('upload_by',$userId)->count();
    $reminderCount = Appointment::where('user_id',$userId)->count();
    $appointments = Appointment::where('date','>=',date('Y-d-m'))->where('user_id',$userId)->get();
    
?>

<style type="text/css">
            body{
              background-color: #f6f6f6;
            }
            .case_details_table , tbody , tr , td ,th{
                border:1px solid #555;
                padding: 10px;
                background-color: #E9ECEF;
            }
            
            .table
            {
              margin-left: 10px;
            }
            .h2class {
                font-size: 1.1em;
                font-weight: normal;
                padding-top: -10px;
                margin-bottom: 10px;
            }
            .container
            {
              margin-top: 10px;
              margin-bottom:10px;
            }
            .button {
                      background-color: #008CBA;
                        border: none;
                        color: white;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 17px;
                        margin:center;
                        cursor: pointer;
                        -webkit-transition-duration: 0.4s; /* Safari */
                        transition-duration: 0.4s;
                        align-items: center;
                      }
                      .button2:hover {
                        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
                      }
            
                </style>
    
    
    
      <main class="page service-page" style="margin-top:190px">
        <section class="clean-block clean-services dark" >
          <div class="container" >
           
            <div class="row" style="margin-top:1.5rem;">
              <div class="col-md-3 ">
                <div class="card">
                  <div class="card-body" style="text-align:center !important">
                    <p class="card-title text-md-center" style="font-size:25px" >Cases</p>
                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0"> {{$caseCount}}</h3>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
              
              <div class="col-md-3 ">
                <div class="card">
                  <div class="card-body"style="text-align:center !important">
                    <p class="card-title " style="font-size:25px">Documents</p>
                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$docCount}}</h3>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"style="text-align:center !important" >
                    <p class="card-title text-md-center "style="font-size:25px">Appointments</p>
                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$reminderCount}}</h3>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"style="text-align:center !important" >
                    <p class="card-title text-md-center "style="font-size:25px">Lawyers</p>
                    <div class="d-flex flex-wrap justify-content-between justify-content-md-center  align-items-center">
                      <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$clientCount}}</h3>
                     
                    </div>
                    
                  </div>
                </div>
              </div>
              
              <div class="col-sm-12" style="margin-top:1rem;">
                <div class="card" >
                  <div class="card-header" style="font-size:25px">Current Case</div>
                  <div class="card-body" >
                   
                    <div class="card-text">
                        <div class="product-specs" style="font-size:1.1rem; padding-left:3rem;    color:black ">
                          @foreach ($cases as $item)
                              
                          
                          <form>
                                <br>
                                <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Case Type</label>
                                    <div class="col-sm-9">
                                      <input type="email" class="form-control" id="colFormLabel" value="{{$item->category}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Filing Number</label>
                                    <div class="col-sm-9">
                                      <input type="Filing Number" class="form-control" id="colFormLabel" value="{{$item->filing_number}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Filing Date</label>
                                    <div class="col-sm-9">
                                      <input type="Filing Date" class="form-control" id="colFormLabel" value="{{$item->date_of_filing}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Registration Number</label>
                                    <div class="col-sm-9">
                                      <input type="Registration Number" class="form-control" id="colFormLabel" value="{{$item->registration_number}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Registration Date</label>
                                    <div class="col-sm-9">
                                      <input type="Registration Date" class="form-control" id="colFormLabel" value="{{$item->registration_date}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">CNR Number</label>
                                    <div class="col-sm-9">
                                      <input type="CNR Number" class="form-control" id="colFormLabel" value="{{$item->cnr}}" disabled>
                                    </div>
                                  </div>
                                  
                                  <?php 
                                      $hearing = Hearing::where('case_id',$item->case_no)->orderBy('id')->limit(1)->get();
                                    
                                      foreach($hearing->all() as $h){
                                          $firstHearing = $h->starting_date;
                                      }
                                      $hearing = Hearing::where('case_id',$item->case_no)->orderBy('id','DESC')->limit(1)->get();
                                      foreach($hearing->all() as $h){
                                          $nextHearing = $h->next_hearing_date;
                                      }
                                     
                                  ?>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">First Hearing Date</label>
                                    <div class="col-sm-9">
                                      <input type="First Hearing Date" class="form-control" id="colFormLabel" value="{{$firstHearing}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Next Hearing Date</label>
                                    <div class="col-sm-9">
                                      <input type="Next Hearing Date" class="form-control" id="colFormLabel" value="{{$nextHearing}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Stage of Case</label>
                                    <div class="col-sm-9">
                                      <input type="Stage of Case" class="form-control" id="colFormLabel" value="{{$item->status}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Court Number</label>
                                    <div class="col-sm-9">
                                      <input type="Court Number" class="form-control" id="colFormLabel" value="{{$item->court_number}}" disabled>
                                    </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Judge</label>
                                    <div class="col-sm-9">
                                      <input type="Judge" class="form-control" id="colFormLabel" value="{{$item->judge_name}}" disabled>
                                    </div>
                                  </div>
                          </form>
                          <hr>
                          @endforeach  
                        <br>
             <hr>
                                                                                                        
                
                    
                  </div>
                  <h2 class=" text-bold m-0 font-weight-normal">Case Related Documents<span class="float-right"></span></h2>
                        <br>
                        <table id="Table" width="100%" align="center" border="1" class="case_details_table" style="font-size:1em;">
                          <tbody class="text-center">
                            <tr>
                           
                              <th scope="col" >Document Name<br><br><i id="5" class="arrow down" onclick="sortTable(1)"></i></th>
                              <th scope="col" >Document Description<br><br></th>
                              <th scope="col" >Uploaded by<br><br></th>
                              <th scope="col" >Uploaded On<br><br><i id="8" class="arrow down" onclick="sortTable(4)"></i></th>
                             
                              <th scope="col" >view<br><br><br></th>
                                      
                            </tr>
                       @foreach ($cases as $item)
                           <?php 
                              $documents = Doc::where('case_id',$item->case_no)->get();
                           ?>
                           @foreach ($documents as $doc)
                              <tr>
                                <td>{{$doc->document_name}}</td>
                                <td>{{$doc->description}}</td>
                                <td>{{$doc->upload_by}}</td>
                                <td>{{$doc->upload_on}}</td>
                              
                                <td><a href="/view/{{$doc['path']}}"> View</a><br></td>
                                
                                  
                              </tr> 
                           @endforeach
                       @endforeach
                       
                          </tbody>
                        </table> 
                </div>
              </div>
                </div>
              </div> 
            
              
              <div  style="width:98%;margin:auto;margin-top:1.2rem; ">
                <div class="card" style="height:auto;">
                  <div class="card-header" style="font-size:25px">Upcoming Appointments</div>
                  <div class="card-body" style="text-align:justify;">
                   
                    <div class="card-text">
                      <?php 
                        $count = count($appointments);
                        ?>
                      @foreach ($appointments as $a)
                      <div class="row">
                        <div class="col-md-10 product-info" style="margin-left:30px;font-size:20px"><b>{{$a->title}} </b>
                                        
                      <div class="product-specs" style="font-size:0.8em; color:black">
                      <div><span>Description :&nbsp;</span><span class="value">{{$a->description}}</span></div>
                      <div><span>Lawyer :&nbsp;</span><span class="value">{{$a->lawyer_name}}</span></div>
                      <div><span>Date:&nbsp;</span><span class="value">{{$a->date}}</span></div>
                                      
                      </div>
                      </div>
                    </div>
                    @if ($count>1)
                        <hr>
                        <?php
                        $count--;
                        ?>
                    @endif
                      @endforeach
                        
                                          
                                                                                                        
                    </div>
                    
                  </div>
                </div>
              </div>
              
            </div>
          </div>
              </div>
        </section>
      </main>