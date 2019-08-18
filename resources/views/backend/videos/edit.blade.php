@extends('backend.layout.app')

@section('title')
    {{$page_title}}
@endsection

@section('content')

@component('backend.layout.navbar' , ['page_title' => $page_title ])
@endcomponent

@component('backend.shared.edit' , ['page_title' => $page_title , 'tableDescription' => $tableDescription ])

            <form action="{{ route($routeName.'.update' , ['id' => $row]) }}"  method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT" />

                @include('backend.'. $folderName.'.form')

                <button type="submit" class="btn btn-primary pull-right">{{ $button_name }}</button>
                <div class="clearfix"></div>
            </form>
            @slot('video')
                @php  $url= getYoutubeId($row->youtube); @endphp
                @if(!empty($url))
                    <iframe width="260" src="https://www.youtube.com/embed/{{$url}}" frameborder="0" allowfullscreen></iframe>
                    <br>
                @endif
                @if(!empty($row->image))

                    <img  src="{{ img($row->image)}}" width="260px" />
                @endif
            @endslot

@endcomponent

@endsection
