@extends('layouts/app')
<?php 
    use App\CustomUser;
    use App\Hearing;

    $user = auth()->user();
    $userType = "client";
    if (strcmp($user->type,"lawyer")==0)
        $userType = "lawyer";
?>
@section('content')
<main class="page product-page">
    <section class="clean-block clean-product dark">
        <div class="container">
            <div class="block-heading">
                <br>
                
            </div>
            <div class="block-content">
                
                <div class="product-info">
                    <div>
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab" id="description-tab" href="#description">Description</a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" data-toggle="tab" id="specifications-tabs" href="#specifications">Hearings</a></li>
                           
                        </ul>
                        
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active fade show description" role="tabpanel" id="description" style="margin-left:25px !important;">
                                <div class="table-responsive ">
                                    <table class="table" style="border:none">
                                        <tbody >
                                            @foreach ($case->all() as $item)
                                                <?php 
                                                    $hearings = Hearing::where('case_id',$item['case_no'])->orderBy('id','DESC')->get();    
                                                ?>
                                                 <tr>
                                                    <td ><strong>Case Number</strong></td>
                                                    <td>{{$item['case_no']}}</td>
                                                </tr>
                                                <?php 
                                                    $clientName = CustomUser::select('name')->where('id',$item['client_id'])->get();
                                                ?>
                                               
                                                <tr>
                                                    @foreach ($clientName as $i)
                                                        <td ><strong>Client Name</strong></td>
                                                        <td>{{$i['name']}}</td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    <td ><strong>Category </strong></td>
                                                    <td>{{$item['category']}}</td>
                                                </tr>
                                                <tr>
                                                    <td ><strong>Date of filing </strong></td>
                                                    <td>{{$item['date_of_filing']}}</td>
                                                </tr>
                                                <tr>
                                                    <td ><strong>Current Stage</strong></td>
                                                    <td>{{$item['status']}}</td>
                                                </tr>
                                                <tr>
                                                    <td ><strong>Description </strong></td>
                                                    <td>{{$item['description']}}</td>
                                                </tr>
                                                
                                            @endforeach
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <style>
                                    table, tr, td {
                                        border: none !important;
                                    }
                                </style>
                                
                                
                            </div>
                            <div class="tab-pane fade show specifications" role="tabpanel" id="specifications">
                                @foreach ($hearings->all() as $item)
                                <div class="table-responsive ">
                                    <h4 style="margin-left:10px" ><b> Hearing: {{$item['id']}}</b></h4>
                                    <table class="table" style="border:none">
                                        <tbody >
                                            <tr>
                                                <td><strong>Starting Date </strong></td> <td>{{$item['starting_date']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Ending Date </strong></td> <td>{{$item['ending_date']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Description </strong></td><td> {{$item['description']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Judgement </strong></td><td> {{$item['judgement']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Comments </strong> </td><td>{{$item['comments']}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Next Hearing Date </strong></td><td> {{$item['next_hearing_date']}}</td>
                                            </tr>
                                    
                                        </tbody>
                                    </table>
                                </div>
                                    <hr>
                                @endforeach
                                
                                <style>
                                    table, tr, td {
                                        border: none !important;
                                    }
                                </style>
                                
                                
                               
                                {{-- <div class="table-responsive table-bordered">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td class="stat">Display</td>
                                                <td>5.2"</td>
                                            </tr>
                                            <tr>
                                                <td class="stat">Camera</td>
                                                <td>12MP</td>
                                            </tr>
                                            <tr>
                                                <td class="stat">RAM</td>
                                                <td>4GB</td>
                                            </tr>
                                            <tr>
                                                <td class="stat">OS</td>
                                                <td>iOS</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div> --}}
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{-- <div class="clean-related-items">
                    <h3>Related Products</h3>
                    <div class="items">
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/tech/image2.jpg"></a></div>
                                    <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4>$300</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/tech/image2.jpg"></a></div>
                                    <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4>$300</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="#"><img class="img-fluid d-block mx-auto" src="assets/img/tech/image2.jpg"></a></div>
                                    <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                        <div class="rating"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star.svg"><img src="assets/img/star-half-empty.svg"><img src="assets/img/star-empty.svg"></div>
                                        <h4>$300</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
</main>
@endsection
