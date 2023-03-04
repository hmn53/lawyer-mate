@extends('layouts/app')
<?php  
    use App\LawyerProfile;
    $user = auth()->user();
    $user_id = $user->id;
?>
@section('content')

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
        <div class="jumbotron" style="width:70%;margin:auto;margin-top:190px">
            <div class="form" style="width:60%;margin:auto">
            <form action="/update/profile/{{$user_id}}" method="POST">
                @csrf
                <h3 style="text-align:center">Profile</h3>
                <div class="form-group ">
                  <label for="name" class=" col-form-label">Name</label>
                  
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                  
                </div>
                  <div class="form-group ">
                    <label for="description" class=" col-form-label">Description</label>
                    
                    <textarea class="form-control" id="description" name="description" >
                        
                    </textarea>
                    
                  </div>
                  <div class="form-group ">
                      <label for="practice" class=" col-form-label">Practice Areas</label>
                      
                      <div class="checkbox">
                        <label><input type="checkbox" value="Criminal" name="practice[]">Criminal</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Civil" name="practice[]">Civil</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Intellectual Property" name="practice[]">Intellectual Property</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Real Estate" name="practice[]">Real Estate</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Tax" name="practice[]">Tax</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Family Law" name="practice[]">Family Law</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Food and Drugs" name="practice[]">Food and Drugs</label>
                      </div>
                      <div class="checkbox">
                        <label><input type="checkbox" value="Consumer Protection" name="practice[]">Consumer Protection</label>
                      </div>
                      
                  </div> 
                    <div class="form-group ">
                      <label for="city" class=" col-form-label">City</label>
                      
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" >
                      
                    </div>
                    <div class="form-group ">
                        <label for="gender" class=" col-form-label">Gender</label>
                        
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        
                      </div>
                    <div class="form-group ">
                      <label for="birthdate" class=" col-form-label">Birth Date</label>
                      
                        <input type="date" class="form-control" id="birthdate" name="birthdate" >
                      
                    </div>
                    
                    <div class="form-group ">
                      <label for="website" class=" col-form-label">Website</label>
                      
                        <input type="text" class="form-control" id="website" name="website" placeholder="Website"  >
                      
                    </div>
                    <div class="form-group ">
                      <label for="mobile" class=" col-form-label">Phone Number</label>
                      
                      <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Phone Number"  >
                      
                    </div>
            
                    <div class="form-group ">
                      <label for="achievements" class=" col-form-label">Achievements</label>
                      
                          <textarea class="form-control" id="achievements" name="achievements" >
                             
                          </textarea>
                      
                    </div>
                    <div class="form-group ">
                        <label for="office_address" class=" col-form-label">Office Address</label>
                        
                          <input type="text" class="form-control" id="office_address" name="office_address" placeholder="Office Address" >
                        
                      </div>
                    <div class="form-group ">
                        <label for="office_phone" class=" col-form-label">Office Phone</label>
                        
                          <input type="text" class="form-control" id="office_phone" name="office_phone" placeholder="Office Phone" >
                        
                    </div>
                    <div class="form-group ">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
            </div>        
        </div>
@endsection
