@extends('layouts/app')
<?php
    use App\CustomUser;
    use App\Doc;
    use App\CaseTable;
    $user = auth()->user();
    $user_id = $user->id;
    $userType = $user->type;
    $docs = Doc::where('upload_by',$user_id)->get();

?>
@section('content')
<style>
    #content{
        margin-top:3%;
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
      i {

    border: solid #008CBA;
    border-width: 0 3px 3px 0;
    display: inline-block;
    padding: 3px;
  }
  .down {
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
  }
    </style>
<div class="d-flex justify-content-center" style="margin-top:100px">
    <div id="content">
      <div class="jambotron" style="width: 85rem;">
        <div class="card-header py-3" style="background-color:#D0D3D4;">
                <h2 class="text-primary m-0 font-weight-normal">Documents <span class="float-right"></span><a class="btn btn-primary btn-lg float-md-right " href="/docs/upload"> Upload Documents</a></h2>
      </div>
  
              <div class="card-body" style="background-color:#ECF0F1">
                  <div class="row">
                      <div class="col-sm-6 text-nowrap">
                          <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label>Show&nbsp;<select class="form-control form-control-sm custom-select custom-select-sm"><option value="10" selected="">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select>&nbsp;</label></div>
                      </div>
                      <div class="col-sm-6">
                          <div class="text-md-right dataTables_filter" id="dataTable_filter"><label><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                      </div>
                  </div>
                  <div class="table-responsive table" id="dataTable" role="grid" aria-describedby="dataTable_info">
                      <table class="table dataTable text-center" id="Table">
                          <thead>
                              <tr>
                                
                                <th scope="col">Case Number<br><br><i id="0" class="arrow down" onclick="sortTable(0)"></i></th>
                                <th scope="col" style="width: 11 rem;">CDN Number<br><br><br></th>
                                <th scope="col">Client Name<br><br><i id="2" class="arrow down" onclick="sortTable(2)"></i></th>
                                <th scope="col" >Case Category<br><br><i id="3" class="arrow down" onclick="sortTable(3)"></i></th>
                                <th scope="col" >Document Name<br><br><i id="4" class="arrow down" onclick="sortTable(4)"></i></th>
                                <th scope="col" >Document Description<br><br></th>
                                <th scope="col" >Uploaded by<br><br></th>
                                <th scope="col" >Uploaded On<br><br><i id="7" class="arrow down" onclick="sortTable(7)"></i></th>
                                
                                <th scope="col" >View<br><br><br></th>
                                <th scope="col" style="width: 6rem;">Verify<br><br><br></th>
  
                      </tr>
                          </thead>
                          <tbody>
                            @if (strcmp($userType,"lawyer")==0)
                            @foreach ($docs as $item)
                                <?php
                                    $client = CaseTable::where('case_no',$item['case_id'])->get();
                                    foreach ($client as $id) {
                                        $clientId = $id->client_id;
                                        $cnr_number = $id->cnr;
                                        $category = $id->category;
                                    }
                                    $clientDocs = Doc::where('upload_by',$clientId)->get();
                                    // echo $clientId;
                                ?>
                                @foreach ($clientDocs as $i)
                                    <?php
                                        $name = CustomUser::select('name')->where('id',$i['upload_by'])->get();
                                        foreach ($name as $n) {
                                            $userName = $n->name;
                                        }
                                        //echo $userName;
                                    ?>
                                <tr>
                                    
                                    <td>{{$i->case_id}}</td>
                                    <td>{{$cnr_number}}</td>
                                    <td>{{$userName}}</td>
                                    <td>{{$category}}</td>
                                    <td>{{$i->document_name}}</td>
                                    <td>{{$i->description}}</td>
                                    <td>{{$i->upload_by}}</td>
                                    <td>{{$i->upload_on}}</td>
                                    
                                    <td><a href="epdf.pub_introduction-to-algorithms-third-edition.pdf"> Preview</a><br>
                                    <a href="/download/{{$i['path']}}">   Download</a></td>
                                    <td>
                                        <a href="/docs/verify/{{$i['id']}}" style="color: rgb(0,123,255);"><button class="btn btn-success">&#10003;</button></a>
                                        <a href="/docs/unverify/{{$i['id']}}" style="color: rgb(0,123,255);"><button class="btn btn-danger">&#10005;</button></a>
                                   
                                    
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    
                                    <td>{{$item->case_id}}</td>
                                    <td>{{$cnr_number}}</td>
                                    <td>{{$userName}}</td>
                                    <td>{{$category}}</td>
                                    <td>{{$item->document_name}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->upload_by}}</td>
                                    <td>{{$item->upload_on}}</td>
                                    
                                    <td><a href="epdf.pub_introduction-to-algorithms-third-edition.pdf"> Preview</a><br>
                                    <a href="/download/{{$i['path']}}">   Download</a></td>
                                    
                                        <td></td>
                                   
                                    
                                </tr>
                                @endforeach
                            
                            @else
                            @foreach ($docs as $item)
                            <?php
                                $client = CaseTable::where('case_no',$item['case_id'])->get();

                                
                                foreach ($client as $id) {
                                    $clientId = $id->client_id;
                                    $cnr_number = $id->cnr;
                                    $category = $id->category;
                                }
                                $userClient = CustomUser::find($clientId);
                                $userName = $userClient->name;                              
                            ?>
                            <tr>     
                                <td>{{$item->case_id}}</td>
                                <td>{{$cnr_number}}</td>
                                <td>{{$userName}}</td>
                                <td>{{$category}}</td>
                                <td>{{$item->document_name}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->upload_by}}</td>
                                <td>{{$item->upload_on}}</td>
                                
                                <td><a href="/view/{{$item['path']}}"> Preview</a><br>
                                <a href="/download/{{$item['path']}}">   Download</a></td>
                                <td>{{$item->verified}}</td>
                                
                            </tr>
                            @endforeach
                            @endif
                          </tbody>
                      </table>
                  </div>
                  <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 of 1 </p>
                    </div>
  
                </div>
              </div>
    </div>
    </div>
  </div>
  <script>
      function deleteRow(row)
      {
          var i=row.parentNode.parentNode.rowIndex;
          document.getElementById('Table').deleteRow(i);
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
        while(switching) {
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
