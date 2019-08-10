@extends('backend.layout.app')

@php
$title = 'Users';
$Model_name = 'User';
$page_title = 'Create '.$Model_name;
$tableDescription = "Here You Can Add ".$Model_name;
$button_name=" Add ".$Model_name;
@endphp

@section('title')
    {{$page_title}}
@endsection

@section('content')

@component('backend.layout.navbar' , ['page_title' => $page_title ])
@endcomponent
           

<div class="row">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ $page_title }}</h4>
            <p class="card-category">{{ $tableDescription }}</p>
        </div>
        <div class="card-body">
            <form action="{{ route('users.store') }}"  method="POST">
                
                @include('backend.users.form')

                <button type="submit" class="btn btn-primary pull-right">{{ $button_name }}</button>
                <div class="clearfix"></div>
            </form>
        </div>
        </div>
    </div>
</div>
            

@endsection
