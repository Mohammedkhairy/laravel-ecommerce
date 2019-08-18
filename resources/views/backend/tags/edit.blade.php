@extends('backend.layout.app')

@section('title')
    {{$page_title}}
@endsection

@section('content')

@component('backend.layout.navbar' , ['page_title' => $page_title ])
@endcomponent

@component('backend.shared.edit' , ['page_title' => $page_title , 'tableDescription' => $tableDescription ])
           
            <form action="{{ route($routeName.'.update' , ['id' => $row]) }}"  method="POST">
                <input type="hidden" name="_method" value="PUT" />
                
                @include('backend.'. $folderName.'.form')

                <button type="submit" class="btn btn-primary pull-right">{{ $button_name }}</button>
                <div class="clearfix"></div>
            </form>
            
@endcomponent

@endsection
