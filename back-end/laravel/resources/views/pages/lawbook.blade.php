@extends('layouts/app')
<?php
    use App\Directory;
   if(!isset($message)){
      if(!isset($laws))
        $laws = Directory::inRandomOrder()->limit(50)->orderBy('penal_code')->get();
   }	
    

?>
@section('content')
<div class="main-container">
    <div class="wrap" >
        
          <form id="search" method="POST" action="/search/lawbook" style="margin:0; padding:0">
            {{ csrf_field() }}
            <div class="search">
            <input type="text" class="searchTerm" name="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
              <i class="fa fa-search"></i>
            </button>
          </div>
          </form>
        
    </div>
    <div class="jumbotron" style="width:80%; margin:auto;margin-top:210px">
        <div class="container">
          @if (!isset($message))
              @foreach ($laws->all() as $law)
              <h4>{{$law->name}}</h4>
              <p class="more" id="more">{{$law->detail}}</p>
              <p>{{$law->penal_code}}</p>
              <hr>
              @endforeach
          @else
              <h3>{{$message}}</h3>
          @endif
        </div>
        {{-- <button class="btn btn-primary" style="margin-left:20px">Load More</button> --}}
      </div>
      
</div>
    

 <style>
     @import url(https://fonts.googleapis.com/css?family=Open+Sans);

.main-container{
    margin:0;
    padding:0;
}
.wrap{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 150%;
  position: relative;
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;
  padding: 5px;
  height: 40px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
  font-size:19px;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  width: 40px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}

.wrap{
  width: 30%;
  position: absolute;
  top: 50%;
  left: 43%;
  top:20%;
  transform: translate(-50%, -50%);
}

a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;
}
</style>
@endsection

