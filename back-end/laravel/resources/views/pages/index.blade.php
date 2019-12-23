@extends('layouts/app')

@section('content')
<div class="container">
<div class="jumbotron">
    <h1 class="display-4 d-flex justify-content-center">Web Portal for Lawyers</h1>
    <p class="lead d-flex justify-content-center"> </p>
    <hr class="my-4">
    <p class="lead d-flex justify-content-center">Quick Start </p>
    
    {{-- <div class="row justify-content-md-center" style="margin-top:40px">
            
            <div class="col-md-auto">
                    <a class="btn btn-primary btn-lg"  href="#" role="button">Learn more</a>
                    <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </div>
            
          </div> --}}
    <div class="row" style="margin-top:40px">
        <div class='col'>
            <div class="d-flex justify-content-end">
                    <a class="btn btn-primary btn-lg"  href="/register" role="button">Lawyer Register</a>
            </div>
        </div>
        <div class='col'>
                <a class="btn btn-primary btn-lg"  href="/register" role="button">Client Register</a>
        </div>
    </div>
</div>
</div>
@endsection