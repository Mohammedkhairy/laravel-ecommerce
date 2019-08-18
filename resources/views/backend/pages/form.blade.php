
@CSRF
<div class="row">
    <div class="col-md-6">
    @php $input = "name"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">name</label>
        <input type="text" name="{{$input}}" value="{{ $row->$input ?? old($input) }}" class="form-control @error($input) is-invalid @enderror">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
    @php $input = "meta_keywords"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Meta Keywords</label>
        <input type="test" name="{{$input}}" value="{{ $row->$input ?? old($input) }}" class="form-control @error($input) is-invalid @enderror">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
    @php $input = "des"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Description</label>
        <textarea name="{{$input}}" col="30" rows="10"  class="form-control @error($input) is-invalid @enderror"> {{ $row->$input ?? old($input) }} </textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="col-md-6">
    @php $input = "meta_des"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Meta Description</label>
        <textarea name="{{$input}}" col="30" rows="10"  class="form-control @error($input) is-invalid @enderror"> {{ $row->$input ?? old($input) }} </textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

</div>
