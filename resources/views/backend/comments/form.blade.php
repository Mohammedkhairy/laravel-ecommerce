<div class="col-md-12">
    @php $input = "comment"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Comments</label>
        <textarea name="{{$input}}" col="30" rows="2"  class="form-control @error($input) is-invalid @enderror"> {{ isset($row)  &&  $row->$input ? $row->$input : old($input) }} </textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
