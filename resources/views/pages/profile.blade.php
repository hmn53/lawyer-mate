@extends('layouts/app')
<?php  
    use App\LawyerProfile;
    $user = auth()->user();
    $user_id = $user->id;
    
      $profile = LawyerProfile::where('user_id',$user_id)->get();
?>
@section('content')
@if (count($profile)==0)
    @include('pages.updateProfile');
@else
<style>
        
    .header {
        margin-top: 2%;
    }
    .description ul li {
        list-style: none;
    }
    .box-1{
        margin-bottom: 1%;
    }
    .button {
        background-color: #008CBA;
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 4px 2px;
          cursor: pointer;
          -webkit-transition-duration: 0.4s; /* Safari */
          transition-duration: 0.4s;
          align-items: center;
        }
        .button2:hover {
          box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
        }
        </style>
        @foreach ($profile->all() as $p)
    <div class="d-flex justify-content-center">  
        <div class="jumbotron w-75" style="margin-top:120px">
            <div class="container" >
            <h2 class="display-4" style="text-align:center">{{$user->name}}</h1>
                <form>
                    <fieldset disabled>
            <div class="description">
                <h3>
                <b>Description :</b>
                </h3>
               
                   
                   
                            <div class="form-group row">
                                <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Description</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value=" {{$p->long_description}}">
                                </div>
                              </div>
                              
                       
                
            
        </div>  
        <form>
            <fieldset disabled>
        <div class="Practice-area">
        <h3>
        <b>Practice areas :</b>
        </h3>
            
            
                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Areas</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->area}}">
                        </div>
                      </div>
                      
               
        </div>
        
    
           
                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">City</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->city}}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Gender </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->gender}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Birthdate  </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->birth_date}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Website </label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->website}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Mobile Number</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->mobile_phone}}">
                        </div>
                    </div>
                    
                </fieldset>
            </form>
       
  
                
               <h3>
                <b >Achievements:</b></h3>
                    
                    <form>
                        <fieldset disabled>
                            <div class="form-group row">
                                <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg">Achievements</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->achievements}}">
                                </div>
                              </div>
                              
                        </fieldset>
                      </form>
            
        
                    
                    <h3><b >Office Details: </b></h3>
                <form>
                    <fieldset disabled>
                        <div class="form-group row">
                            <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg">Office address</label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->office_address}}">
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="colFormLabelLg" class="col-sm-3 col-form-label col-form-label-lg">Office contact Num.</label>
                            <div class="col-sm-9">
                              <input type="email" class="form-control form-control-lg" id="colFormLabelLg" value="{{$p->office_phone}}">
                            </div>
                          </div>
                          
                    </fieldset>
                  </form>
                  <button class="btn btn-primary"  ><a href="/profile/update/{{$p->id}}" style="color:white;text-decoration:none">Update Profile</a></button>
                
                  @endforeach
                </div>
            </div>
        </div>
        
               
               
          
                
            @endif
@endsection
