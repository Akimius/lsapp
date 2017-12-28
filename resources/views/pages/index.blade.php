@extends('layouts.app')
      
@section('content')
    <div class="jumbotron text-center">
    <h1>{{$title}}</h1>
        <p>This is Laravel application from Scratch</p>
        
        <a href="/login"><button type="button" class="btn btn-primary">Login</button></a>
        <a href="/register"><button type="button" class="btn btn-success">Register</button></a>
    </div>
@endsection
