@extends('backend.layout.app')
@section('title')
    Messages
@endsection
@section('content')
@component('backend.layout.navbar' , ['page_title' => 'Messages']) 

@endcomponent

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h3>Online Users</h3>
            <hr>
            <ul class="list-group" id="online-user">                
            </ul>
        </div>
    </div>
</div>

@endsection
