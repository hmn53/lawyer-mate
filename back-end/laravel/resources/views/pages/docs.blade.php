@extends('layouts/app')
<?php 
    $user_id = auth()->user()->id;
    $docs = DB::table('documents')->select('*')->where('upload_by',$user_id)->get();
    $result = json_decode($docs,true);
?>
@section('content')
<main class="page shopping-cart-page">
  <section class="clean-block clean-cart dark">
      <div class="container" >
          <div class="block-heading">
              <h2 class="text-info">Documents</h2>
          </div>
          <div class="content">
              <div class="row no-gutters">
                  <div class="col-md-12 col-lg-8">
                      <div class="items">
                        
                            @foreach ($result as $item)
                          <div class="product">
                              <div class="row justify-content-center align-items-center">
                                 
                                  <div class="col-md-5 product-info" style="margin-left:30px"><a class="product-name" href="#">{{$item['document_name']}}</a>
                                      <div class="product-specs">
                                          <div><span>Case Number:&nbsp;</span><span class="value">{{$item['case_id']}}</span></div>
                                          <div><span>Uploaded by:&nbsp;</span><span class="value">{{$item['upload_by']}}</span></div>
                                          <div><span>Upload Date:&nbsp;</span><span class="value">{{$item['upload_on']}}</span></div>
                                      </div>
                                  </div>
                                  <div class="col" style="margin-left:130px">
                                      <a href="/download/{{$item['path']}}" style="color: rgb(0,123,255);">Download</a>
                                  </div>
                              </div>
                          </div>
                          @endforeach
                          
                          <div class="product"></div>
                      </div>
                  </div>
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
