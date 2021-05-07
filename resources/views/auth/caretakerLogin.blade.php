@extends('auth.template')
    @section('content')
    <form method="POST" action="{{route('register')}}">
        @csrf
        
    </form>
    @endsection