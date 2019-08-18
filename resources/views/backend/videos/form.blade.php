
@CSRF
<div class="row">
    <div class="col-md-6">
    @php $input = "name"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">name</label>
        <input type="text" name="{{$input}}" value="{{ isset($row)  && $row->$input ? $row->$input : old($input) }}" class="form-control @error($input) is-invalid @enderror">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
    
    <div class="col-md-6">
    @php $input = "youtube"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Youtube Url</label>
        <input type="url" name="{{$input}}" value="{{ isset($row)  &&  $row->$input ? $row->$input : old($input) }}" class="form-control @error($input) is-invalid @enderror">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
    @php $input = "cat_id"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Category</label>
        <!-- <input type="url" name="" value= > -->
        <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}">
        @foreach($categories as $cat)
        <option style="color:black" value="{{$cat->id}}" {{ (isset($row)  && $row->$input == $cat->id)? 'selected' : ''}} >{{$cat->name}}</option>
        @endforeach
        </select>
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
        <input type="test" name="{{$input}}" value="{{ isset($row)  &&  $row->$input ? $row->$input : old($input) }}" class="form-control @error($input) is-invalid @enderror">
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
        <textarea name="{{$input}}" col="30" rows="5"  class="form-control @error($input) is-invalid @enderror"> {{ isset($row)  &&  $row->$input ? $row->$input : old($input) }} </textarea>
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
        <textarea name="{{$input}}" col="30" rows="5"  class="form-control @error($input) is-invalid @enderror"> {{ isset($row)  &&  $row->$input ? $row->$input : old($input) }} </textarea>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>


    <div class="col-md-6">
    @php $input = "skills[]"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Skills</label>
        <!-- <input type="url" name="" value= > -->
        <select multiple style="height:100px;" class="form-control @error($input) is-invalid @enderror" name="{{$input}}">
        @foreach($skills as $skill)
        <option value="{{$skill->id}}" {{ (in_array($skill->id , $selectedSkills))? 'selected' : ''}} >{{$skill->name}}</option>
        @endforeach
        </select>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>

    <div class="col-md-6">
    @php $input = "tags[]"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Tags</label>
        <!-- <input type="url" name="" value= > -->
        <select multiple style="height:100px;" class="form-control @error($input) is-invalid @enderror" name="{{$input}}">
        @foreach($tags as $tag)
        <option value="{{$tag->id}}" {{ (in_array($tag->id , $selectedTags))? 'selected' : ''}} >{{$tag->name}}</option>
        @endforeach
        </select>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
    @php $input = "image"; @endphp
    <div >
        <label >image</label>
        <input type="file" name="{{$input}}" class="form-control @error($input) is-invalid @enderror">
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
    <div class="col-md-6">
    @php $input = "published"; @endphp
    <div class="form-group bmd-form-group">
        <label class="bmd-label-floating">Video Statue</label>
        <!-- <input type="url" name="" value= > -->
        <select class="form-control @error($input) is-invalid @enderror" name="{{$input}}">
        <option style="color:black" value="1" {{ (isset($row)  && $row->$input == 1)? 'selected' : ''}} >published</option>
        <option style="color:black" value="0" {{ (isset($row)  && $row->$input == 0)? 'selected' : ''}} >hidden</option>
        </select>
        @error($input)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    </div>
</div>
