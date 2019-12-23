@extends('layouts.app')

@section('content')

<?php
$user = auth()->user();
?>
@if (strcmp($user->type,"lawyer")==0)
    @include('includes.lawyer')
@else
    @include('includes.client')
    
@endif

@endsection
