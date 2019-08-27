

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">messages</div>

                <div class="card-body row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-md-3">
                        <h3>Online Users</h3>
                        <hr>
                        <h5 id="noUser">No Online User</h5>
                        <ul class="list-group" id="online-user">                
                        </ul>
                    </div>
                    <div class="col-md-9 flex-colum" style="height : 70vh">
                        <div class="mb-4 p-5" id="chat" style="height:90%;overflow-y:scroll;background-color:#f7f7f7">
                            @foreach($messages as $message)    
                                <div style="width:auto" class="mt-2 p-2 rounded {{ auth()->user()->id == $message->user_id? 'float-right  bg-primary' : 'float-left bg-warning'}}">
                                    <p>{{ $message->message }}</p>
                                </div>
                                <div class="clearfix"></div>
                            @endforeach
                        </div>
                        
                        <div>
                            <form class="d-flex" action="">
                                <input type="text" data-url="{{ route('messages.store') }}" id="chat-text" class="form-control" style="margin:0 10px 10px 10px"/>
                                <button class="btn btn-primary" style="height : 5vh">Send</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
