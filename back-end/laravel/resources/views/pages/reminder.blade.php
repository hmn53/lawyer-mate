<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Web Portal for Lawyers</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap2.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="{{asset('css/smoothproducts.css')}}">
</head>
<body>
  @include('includes/newnavbar')
  <?php
  $user_id = auth()->user()->id;
  $case_info = DB::table('case_table')->select('case_no')->where('lawyer_id',$user_id)->get();
  $result1 = json_decode($case_info, true);
?>

<main class="page contact-us-page">
    <section class="clean-block clean-form dark">
    <div class="container">
      <div class="block-heading">
        <h2 class="text-info">Add Reminder</h2>
    </div>
    <form action="/reminder" method="POST">
        @csrf
          <div class="form-group ">
            <label for="type" class=" col-form-label">Type</label>
                <select class="form-control" id="type" name="type">
                    <option>Appointment</option>
                    <option>Hearing</option>
                </select>
          </div>
          <div class="form-group ">
              <label for="description" class=" col-form-label">Description</label>
              <textarea class="form-control" id="description" name="description"></textarea>
          </div> 
            <div class="form-group ">
                <label for="case_no" class=" col-form-label">Case Number</label>
              
                <select class="form-control" id="case_no" name="case_no">
                    @foreach ($result1 as $case)
                    <option>{{$case['case_no']}} </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group ">
              <label for="reminddate" class=" col-form-label">Remind Date</label>
              
                <input type="date" class="form-control" id="reminddate" name="reminddate">
              
            </div>
          <div class="form-group ">
            
              <button type="submit" class="btn btn-primary">Submit</button>
            
          </div>
        </form>
   
  </div>
  </section>
  </main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
    <script src="{{asset('js/smoothproducts.min.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>
</body>

</html>
