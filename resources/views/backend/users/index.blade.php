@extends('backend.layout.app')


@section('title')
    {{$page_title}}
@endsection

@section('content')

@component('backend.layout.navbar' , ['page_title' => $page_title ])
@endcomponent
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title ">{{$title}} Table</h4>
                            <p class="card-category"> {{$tableDescription}}</p>
                        </div>
                        <div class="col-md-4 text-right">
                            <a href="/admin/users/create" class="btn btn-white btn-round">Add {{$Model_name}} <div class="ripple-container"></div></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <tr>
                                <th> Id </th>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Created At </th>
                                <th> Control </th>
                            </tr>
                        </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                              <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                            <td class="td-actions ">
                                <a href="{{ route('users.edit' , ['id' => $user->id]) }}" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Edit {{ $Model_name}}">
                                    <i class="material-icons">edit</i>
                                </a>
                                <form action="{{ route('users.destroy' , ['id' => $user->id ]) }}" method="POST">
                                  @CSRF
                                  <input type="hidden" name="_method" value="delete"/>
                                  <button  rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Remove {{ $Model_name}}">
                                      <i class="material-icons">close</i>
                                  </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                
                </div>
              </div>
            </div>

@endsection
