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
<main class="page shopping-cart-page" style="font-size: 1.2rem;">
  <section class="clean-block clean-cart dark">
      <div class="container" >
          <div class="block-heading">
              <h2 class="text-info">Documents</h2>
          </div>
          <div class="content">
              <div class="row no-gutters">
                  <div class="col-md-12 col-lg-8">
                      <div class="items" >
                            @if (strcmp($userType,"lawyer")==0)
                                    @foreach ($docs as $item)
                                    <?php 
                                        $client = CaseTable::select('client_id')->where('case_no',$item['case_id'])->get();
                                        foreach ($client as $id) {
                                            $clientId = $id->client_id;
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
                                    <div class="product">
                                        <div class="row justify-content-center align-items-center">
                                        @if (strcmp($i['verified'],"pending")==0)
                                        <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" href="#">{{$i['document_name']}}</a>
                                        @endif
                                        @if (strcmp($i['verified'],"verified")==0)
                                        <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" style="color:green"href="#">{{$i['document_name']}}</a>
                                        @endif
                                        @if (strcmp($i['verified'],"rejected")==0)
                                        <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" style="color:red"href="#">{{$i['document_name']}}</a>
                                        @endif
                                            <div class="product-specs" style="font-size:0.85em;">
                                                <div><span>Case Number:&nbsp;</span><span class="value">{{$i['case_id']}}</span></div>
                                                
                                                    <div><span>Uploaded by:&nbsp;</span><span class="value">{{$userName}}</span></div>
                                                
                                                
                                                <div><span>Upload Date:&nbsp;</span><span class="value">{{$i['upload_on']}}</span></div>
                                            </div>
                                        </div>
                                        <div class="col" style="margin-left:130px">
                                            <a href="/download/{{$i['path']}}" style="color: rgb(0,123,255);"><button class="btn btn-primary">Download </button></a>
                                            
                                            @if (strcmp($i['verified'],"pending")==0)
                                                <a href="/docs/verify/{{$i['id']}}" style="color: rgb(0,123,255);"><button class="btn btn-success">	&#10003; </button></a>
                                                <a href="/docs/unverify/{{$i['id']}}" style="color: rgb(0,123,255);"><button class="btn btn-danger">	&#10005; </button></a>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="product">
                                    <div class="row justify-content-center align-items-center">
                                        
                                        <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" href="#">{{$item['document_name']}}</a>
                                            <div class="product-specs" style="font-size:0.85em;">
                                                <div><span>Case Number:&nbsp;</span><span class="value">{{$item['case_id']}}</span></div>
                                                
                                                    <div><span>Uploaded by:&nbsp;</span><span class="value">me</span></div>
                                                
                                                
                                                <div><span>Upload Date:&nbsp;</span><span class="value">{{$item['upload_on']}}</span></div>
                                            </div>
                                        </div>
                                        <div class="col" style="margin-left:130px">
                                            <a href="/download/{{$item['path']}}" style="color: rgb(0,123,255);"><button class="btn btn-primary">Download </button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                                @endforeach
                                
                            @else
                               @foreach ($docs as $i)
                               <div class="product">
                                <div class="row justify-content-center align-items-center">
                                @if (strcmp($i['verified'],"pending")==0)
                                <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" href="#">{{$i['document_name']}}</a>
                                @endif
                                @if (strcmp($i['verified'],"verified")==0)
                                <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" style="color:green"href="#">{{$i['document_name']}}</a>
                                @endif
                                @if (strcmp($i['verified'],"rejected")==0)
                                <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" style="color:red"href="#">{{$i['document_name']}}</a>
                                @endif
                                    <div class="product-specs" style="font-size:0.85em;">
                                        <div><span>Case Number:&nbsp;</span><span class="value">{{$i['case_id']}}</span></div>
                                        
                                            <div><span>Uploaded by:&nbsp;</span><span class="value">me</span></div>
                                        
                                        
                                        <div><span>Upload Date:&nbsp;</span><span class="value">{{$i['upload_on']}}</span></div>
                                    </div>
                                </div>
                                <div class="col" style="margin-left:130px">
                                    <a href="/download/{{$i['path']}}" style="color: rgb(0,123,255);"><button class="btn btn-primary">Download </button></a>
                                    
                                   
                                    
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                              
                            @endif
                            
                          <div class="product"></div>
                      
                  <div class="col-md-12 col-lg-4">
                      <div class="summary">
                          <h3>Upload<br>Documents&nbsp;</h3><a href="/docs/upload"class="btn btn-primary btn-block btn-lg" type="button">Upload</a></div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</main>
@endsection
