@extends('backend.layout.app')


@section('title')
    {{$page_title}}
@endsection

@section('content')

  @component('backend.layout.navbar' , ['page_title' => $page_title ])
  @endcomponent

  @component('backend.shared.table' , [
                                      'title' => $title ,
                                      'tableDescription' => $tableDescription ,
                                      'page_title' => $page_title 
                                      ])
    @slot('addButton')
          <div class="col-md-4 text-right">
              <a href="/admin/{{ $routeName}}/create" class="btn btn-white btn-round">
                Add {{$Model_name}} 
                <div class="ripple-container"></div>
              </a>
          </div>
    @endslot

    <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th> Id </th>
                                <th> Name </th>
                                <th> Meta Keywords </th>
                                <th> Description </th>
                                <th> Meta Description </th>
                                <th> Created At </th>
                                <th> Control </th>
                            </tr>
                        </thead>
                      <tbody>
                        @foreach($rows as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->meta_keywords}}</td>
                            <td>{{$row->des}}</td>
                            <td>{{$row->meta_des}}</td>
                              <td>{{\Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                            <td class="td-actions ">
                                @include('backend.shared.buttons.edit')
                                @include('backend.shared.buttons.delete')
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

  @endcomponent

@endsection
