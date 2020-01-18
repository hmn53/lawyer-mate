@extends('layouts.app')

@section('content')
    

<main class="page landing-page">
        <section class="clean-block clean-hero" style="background-image: url({{ asset('images/background.jpg') }});color: rgba(9, 162, 255, 0.85);">
                <div class="text">
                        <h2>Web Portal for Lawyers</h2>
                        <p>Get started now.</p>
                        <button class="btn btn-outline-light btn-lg" type="button"><a href="/register" style="text-decoration: none; color:white;">Register</a></button>
                </div>
        </section>
</main>
@endsection