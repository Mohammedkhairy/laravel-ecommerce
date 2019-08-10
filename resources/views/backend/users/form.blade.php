@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@CSRF
            <div class="row">
                <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Username</label>
                    <input type="text" name="name" value="{{ $user->name ?? '' }}" class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email address</label>
                    <input type="email" name="email" value="{{ $user->email ?? '' }}" class="form-control">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Password </label>
                    <input type="password" name="password" class="form-control">
                </div>
                </div>
                
            </div>