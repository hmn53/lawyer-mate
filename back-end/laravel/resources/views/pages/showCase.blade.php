@extends('layouts/app')
<?php 
    use App\CustomUser;
    use App\Hearing;
    use App\Doc;

    $user = auth()->user();
    $userType = "client";
    if (strcmp($user->type,"lawyer")==0)
        $userType = "lawyer";
?>
@section('content')
<style type="text/css">
      
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
        <?php 
            $client = CustomUser::find($case['client_id']);
        ?><div style="margin-top:140px">
        <h1 class="text-center">Case Details</h1>
        <br>
        <div class="container">
          
        <table width="100%" class="case_details_table" style="font-size:1em; ">
          <tr>
            <td ><label style="font-weight:bold;">Client's Name</label>
            </td>
            <td colspan="3" style="text-transform:uppercase;font-size:1.1em;font-weight:bold;">{{$client->name}}</td>
          </tr>
            <tr>
              <td ><label style="font-weight:bold;">Case Type</label>
              </td>
              <td colspan="3" style="text-transform:uppercase;font-size:1.1em;font-weight:bold;">{{$case->type}}</td>
            </tr>
            <tr>
              <td>
                <label style="font-weight:bold;">Filing Number</label>
              </td>
              <td style="font-weight:bold;">{{$case->filing_number}} &nbsp;</td>
              <td >
                <label style="font-weight:bold;">Filing Date</label>
              </td>
              <td style="font-weight:bold;"> {{$case->filing_date}} &nbsp;</td>
            </tr>
              <tr>
                <td><label style="font-weight:bold;">Registration Number</label></td>
                <td>
                  <label style="font-weight:bold;">{{$case->registration_number}}</label>
                </td>
                <td><label style="font-weight:bold;">Registration Date</label>
                </td>
                <td>
                  <label style="font-weight:bold;">{{$case->registration_date}}</label>
                </td>
              </tr>
              <tr>
                <td><b>
                  <label style="font-weight:bold;">CNR Number</label></b>
                </td>
                <td colspan="3">
                  <span style="font-size:1.2em;font-weight:bold;color:#df3527">{{$case->cnr}}</span>
                </td>
              
            </tr>
        
    
              </table>
              <br>
              <br>
              <h2 class=" text-bold m-0 font-weight-normal">Case Status <span class="float-right"></span><button class="button button2 float-md-right " data-toggle="modal" data-target="#update_status">Update Status</button></h2>
              <br>
               <table width="100%"  class="case_details_table" style="font-size:1em;">
                <?php 
                    $hearing = Hearing::where('case_id',$case->case_no)->orderBy('id')->limit(1)->get();
                  
                    foreach($hearing->all() as $h){
                        $firstHearing = $h->starting_date;
                    }
                    $hearing = Hearing::where('case_id',$case->case_no)->orderBy('id','DESC')->limit(1)->get();
                    foreach($hearing->all() as $h){
                        $nextHearing = $h->next_hearing_date;
                    }
                ?>
                
                  <tr>
                    <td>
                      <label><strong>First Hearing Date </strong></label>
                    </td>
                    <td colspan="4"><strong>{{$firstHearing}}</strong></td>
                  </tr>
                  <tr>
                    <td><label><strong>Next Hearing Date</strong></label></td>
                    <td colspan="4"><strong>{{$nextHearing}}</strong></td>
                  </tr>
                  <tr>
                    <td><label><strong>Stage of Case</strong></label></td>
                    <td colspan="4"><label><strong>{{$case->status}}</strong></label></td>
                  </tr>
                  <tr>
                    <td><label><strong>Court Number </strong></label></td>
                    <td colspan="4"><label><strong>{{$case->court_number}}</strong></label></td>
                  </tr>
                  <tr>
                    <td><label><strong>Judge</strong></label></td>
                    <td colspan="4"><label><strong> {{$case->judge_name}}</strong></label></td>
                  </tr>
                
              </table>
              
              <br>
              <h2 class=" text-bold m-0 font-weight-normal">Case Related Acts<span class="float-right"></span><button class="button button2 float-md-right " data-toggle="modal" data-target="#update_acts">Update Acts</button></h2>
                <br> 
              <table width="100%"  class="case_details_table" style="font-size:1em;">
                <tbody>
                  <tr>
                    <th><strong>Under Act(s)</strong></th><th><b>Under Section(s)</b></th>
                  </tr>
                  <tr>
                    <td><label><strong>PENAL CODE</strong></label></td>
                    <td colspan="4"><label><strong> {{$case->penal_code}}</strong></label></td>
                  </tr>
                 
                 
                </tbody>
              </table>
              
              <br>
              <h2 class=" text-bold m-0 font-weight-normal">Petitioner<span class="float-right"></span><button class="button button2 float-md-right " data-toggle="modal" data-target="#update_pdetails">Update Details</button></h2>
              <br>
              <table width="100%" class="case_details_table" style="font-size:1em;">
                <tbody>
                  <tr>
                    
                      <td><label><strong>Petitioner</strong></label></td>
                      <td colspan="4"><label><strong>{{$case->petitioner}}</strong></label></td>
                    
                  </tr>
                  
                </tbody>
              </table>
              <br>
    
              <h2 class=" text-bold m-0 font-weight-normal">Respondent<span class="float-right"></span><button class="button button2 float-md-right " data-toggle="modal" data-target="#update_rdetails">Update Details</button></h2>
              <br>
             <table width="100%" align="center" border="1" class="case_details_table" style="font-size:1em;">
                <tbody>
                  <tr>
                    
                    <td><label><strong>Respondent</strong></label></td>
                    <td colspan="4"><label><strong>{{$case->respondent}}</strong></label></td>
                  
                </tr>
                
                </tbody>
              </table>
    
              <br>
              <br>
             <h2 class=" text-bold m-0 font-weight-normal">Case Description<span class="float-right"></span></h2>
             <br>
             <table width="100%" class="case_details_table" style="font-size:1em;">
               <tbody>
                 <tr>
                   
    
                     <td colspan="4"><label><b>{{$case->description}}</b></label></td>
                  
                 
               </tr>
               </tbody>
             </table>
             <br>
             <?php 
                $docs = Doc::where('case_id',$case->case_no)->get();
             ?>
              <h2 class=" text-bold m-0 font-weight-normal">Case Related Documents<span class="float-right"></span><a class="btn btn-primary btn-lg float-md-right " href="/docs/upload">Upload Documents</a></h2>
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
                  @foreach ($docs as $doc)
                  <tr>
                    <td>{{$doc->document_name}}</td>
                    <td>{{$doc->description}}</td>
                    <td>{{$doc->upload_by}}</td>
                    <td>{{$doc->upload_on}}</td>
                    <td><a href="/view/{{$doc['path']}}"> Preview</a><br>
                    <a href="/download/{{$doc['path']}}">Download</a></td>
                    
                  </tr> 
                  @endforeach
                
                </tbody>
              </table>
              <?php 
                    $hearings = Hearing::where('case_id',$case['case_no'])->get();  
            ?>
              <br>
              <h2 class=" text-bold m-0 font-weight-normal">History of all Hearings<span class="float-right"></span><button class="button button2 float-md-right " data-toggle="modal" data-target="#upload_docs">Add Hearings</button></h2>
              <br>
              <table width="100%"  class="case_details_table" style="font-size:1em;">
                <tr>
                  <th>Starting date</th>
                <th>Description</th>
                  <th>Judgement</th>
                  <th>Comments</th>
                  <th>View Details</th>
                </tr>
                @foreach ($hearings as $h)
                    
                
                <tr>
                  <strong>
                 
                  <td><label>{{$h->starting_date}}</label></td>
                  <td><label>{{$h->description}}</label></td>
                  <td><label>{{$h->judgement}}</label></td>
                  <td><label>{{$h->comments}}</label></td>
                  <td><a href="/hearing/{{$h->id}}"><button type="button" class="button button2  p-2">View More</button></a></td>
                </strong>
              
                </tr>
                @endforeach
            </table>
             <br>
             
    
    
    
    </div>
    <!-- MODELS -->
        
    <!-- The Modal -->
    <div class="modal" id="upload_docs">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Add Hearing Details</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
          <form action="/add/hearing/{{$case->id}}" method="post">
            @csrf
            <label for="judge_name">Judge Name</label>
          <input type="text" class="form-control" id="judge_name" placeholder="Judge Name" name="judge_name" required>
            <label for="description">Description</label>
            <textarea class="form-control" rows="5" id="description" name="description" required></textarea>
          <label for="judgement">Judgement</label>
        <input type="text" class="form-control" id="judgement" placeholder="Judgement" name="judgement" required>
        <div class="form-group">
        <label for="starting_date">Starting Date</label>
        <input type="date" name="starting_date" id="starting_date">
      </div>
      <div class="form-group">
        <label for="ending_date">Ending Date</label>
        <input type="date" name="ending_date" id="ending_date">
      </div>
            
            <div class="form-group">
              <label for="comments">Comments</label>
              <textarea class="form-control" rows="5" id="comments" name="comments" required></textarea>
            </div>
            <div class="form-group">
              <label for="next_hearing_date">Next Hearing Date</label>
              <input type="date" name="next_hearing_date" id="next_hearing_date">
            </div> 
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>  
          </form>
          </div>
          
    
          <!-- Modal footer -->
          
    
        </div> 
      </div>
    </div>
        
    <!-- The Modal -->
    <div class="modal" id="update_status">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Status</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body p-3">
          <form action="/update/status/{{$case->id}}" method="post">
              @csrf
            <label for="court_number">Court Number</label>
          <input type="text" class="form-control" id="court_number" placeholder="Court Number" name="court_number" required>
            <label for="judge_name">Judge</label>
            
            <input type="text" class="form-control" id="judge_name" placeholder="Judge Name" name="judge_name" required>
            <label for="uname">Court Status</label>  
            
    <div class="input-group mb-5">   
      <div class="input-group-prepend">
        <label class="input-group-text" for="status">Status</label>
      </div>
      <select class="custom-select" id="status" name="status">
        <option >Pending</option>
        <option >In Progress</option>
        <option >Closed</option>
        <option >Left</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
    </div>
    
    <!-- The Modal -->
    <div class="modal" id="update_acts">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Update Acts</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body p-3">
          <form action="/update/acts/{{$case->id}}" method="post">
            @csrf
            <label for="penal_code">Under Act(s)</label>
          <input type="text" class="form-control" id="penal_code" placeholder="Enter Act(s)" name="penal_code" required>
          <div> 
            <br>
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
    
          </form>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
    </div>
    
    <!-- The Modal -->
    <div class="modal" id="update_pdetails">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">UPDATE PETITIONER</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body p-3">
          <form action="/update/petitioner/{{$case->id}}" method="post">
            @csrf
            <label for="petitioner">Petitioner</label>
          <input type="text" class="form-control" id="petitioner" placeholder="Petitioner Name" name="petitioner" required>
            <div>
              <br>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            
    
          </form>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
    </div>
    
    <div class="modal" id="update_rdetails">
      <div class="modal-dialog">
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">UPDATE RESPONDENT</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body p-3">
          <form action="/update/respondent/{{$case->id}}" method="post">
            @csrf
            <label for="respondent">Respondent</label>
          <input type="text" class="form-control" id="respondent" placeholder="Respondent Name" name="respondent" required>
            <div>
              <br>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            
    
          </form>
          </div>
          
          <!-- Modal footer -->
          <div class="modal-footer">
           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    
        </div>
      </div>
    </div>
    </div>
    
    
    
    <!-- MODELS END+ -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
     
        <script>
          $('#dtBasicExample').mdbEditor({
    mdbEditor: true
    });
    $('.dataTables_length').addClass('bs-select');
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
    
        function deleteRow(row)
        {
            var i=row.parentNode.parentNode.rowIndex;
            document.getElementById('table').deleteRow(i);
        }
    
        function sortTable(n) {
    
          var table, rows, switching, i, x, y, shouldSwitch,j;
          var list=[1,3,4,5,8];
          for(j=0; j < list.length; j++)
            {   if(n==list[j])
                    document.getElementById(n).disabled=false;
                  else {
                    document.getElementById(n).disabled=true;
                  }
            }
          table = document.getElementById("Table");
          switching = true;
          /* Make a loop that will continue until
          no switching has been done: */
          while (switching) {
            // Start by saying: no switching is done:
    
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
              // Start by saying there should be no switching:
              shouldSwitch = false;
              /* Get the two elements you want to compare,
              one from current row and one from the next: */
              x = rows[i].getElementsByTagName("td")[n];
              y = rows[i + 1].getElementsByTagName("td")[n];
              // Check if the two rows should switch place:
              if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
              }
            }
            if (shouldSwitch) {
              /* If a switch has been marked, make the switch
              and mark that a switch has been done: */
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
            }
          }
        }
        </script>
     
     
     
     
@endsection
