<form action="{{ route('comments.store') }}" method="POST">
@csrf
            @include('backend.comments.form')
            <input type="hidden" name="video_id" value="{{ $row->id}}" />
            <button type="submit" class="btn btn-primary pull-right">Add Comment</button>
            <div class="clearfix"></div>
</form>
