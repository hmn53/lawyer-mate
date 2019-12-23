@extends('layouts/app')

@section('content')
    <h1>{{$title}}</h1>
    <p>This is the About Page </p>
    @if (count($services)>0){
        <ul>
        @foreach ($services as $service){
            <li>{{$service}}</li>
        }
        </ul>
        @endforeach
    }
        
    @endif
@endsection