@extends('layouts/app')
<?php 
    use App\LawyerProfile;
    use App\CustomUser;
    $profiles = LawyerProfile::all();
?>
@section('content')
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
  margin-left:400px;
  margin-top:120px;
  /* position: absolute;
  left: 43%;
  top:90%; */
}

a.morelink {
	text-decoration:none;
	outline: none;
}
.morecontent span {
	display: none;
}
        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        
        .imagewithtext {
            vertical-align: middle;
            margin-left: 7rem;
        }
        
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            margin-left: 2em;
            -ms-flex-direction: column;
            padding: 0.5rem;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
        }
        
        .form-control {
            display: block;
            width: 100%;
            height: calc(2.5em + .75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
        
        .search-box {
            width: 450px;
            height: 100px;
            position: relative;
            margin-left: 650px;
        }
        
        .input1 {
            position: absolute;
            top: 20px;
            right: 50px;
            box-sizing: border-box;
            width: 600px;
            height: 70px;
            border: 3px solid black;
            border-radius: 50px;
            padding: 0 20px;
            margin-left: 2rem;
            outline: none;
            font-size: 18px;
            transition: all 0.8s ease;
        }
        
        .btt {
            position: absolute;
            width: 90px;
            height: 90px;
            background: black;
            border-radius: 50%;
            top: 10px;
            border: 3px solid #eee;
            right: 40px;
            cursor: pointer;
            text-align: center;
            line-height: 80px;
            font-size: 20px;
            color: #fff;
            transition: all 0.8s ease
        }
        
        .jumbotron {
            margin-left: 1px;
        }
        
        .card1 {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            margin: 1px;
            -ms-flex-direction: column;
            padding: 0.5rem;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 0.25rem;
        }
    </style>
    <div class="wrap" >
    <form id="search" method="POST" action="/search/lawbook" style="margin:0; padding:0">
        {{ csrf_field() }}
        <div class="search">
        <input type="text" class="searchTerm" name="searchTerm" placeholder="Search Lawyers...">
        <button type="submit" class="searchButton">
          <i class="fa fa-search"></i>
        </button>
      </div>
      </form>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    
                        
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Criminal" name="category[]"> Criminal</label>
                            </div>
                       
                        
                    
                    
                        
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Civil" name="category[]"> Civil</label>
                            </div>
                        
                        
                    
                    
                        
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Intellectual Property" name="category[]"> Intellectual Property</label>
                            </div>
                       
                        
                    
                    
                        
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Real Estate" name="category[]"> Real Estate</label>
                            </div>
                       
                        
                   
                    
                        
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Tax" name="category[]"> Tax</label>
                            </div>
                       
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Family Law" name="category[]"> Family Law</label>
                            </div>
                
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Food and Drugs" name="category[]"> Food and Drugs</label>
                            </div>
                        
                        
                    
                    
                        
                            <div class="input-group-text">
                                <label><input type="checkbox" value="Consumer Protection" name="category[]"> Consumer Protection</label>
                            </div>
                        
                        
                    </div>
            </div>
            <br>
            

        </div>
        <div class="col-sm-7">
            <div class="jumbotron">
                @foreach ($profiles->all() as $profile)
                    <?php 
                        $user = CustomUser::find($profile->user_id);
                    ?>
                    <div class="card1">
                        <div class="card-body">
                            <h5 class="card-title">{{$user->name}}</h5>
                            <p class="card-text">Category : {{$profile->area}}<br>
                                City: {{$profile->city}}</p>
                            <a href="" class="btn btn-primary">View Profile</a>
                        </div>
                    </div>
                @endforeach
               </div>
        </div>
    </div>
@endsection
