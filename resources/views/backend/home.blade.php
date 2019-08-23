@extends('backend.layout.app')
@section('title')
    HomePage
@endsection
@section('content')
@component('backend.layout.navbar' , ['page_title' => 'HomePage']) 

@endcomponent

<h1> welcome to dashboard</h1>
@endsection
