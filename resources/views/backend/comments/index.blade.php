

<table class="table" id="comments">
    <tbody>
    @php $routeName='comments'; @endphp
    @foreach($comments->reverse() as $comment)
        <tr>         
            <td>
            <small>{{ $comment->user->name }}</small>
            <p>{{ $comment->comment }}</p>
            <small>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</small>

            </td>
            <td class="td-actions text-right">
        
            <button type="button" onclick="$(this).closest('tr').next('tr').slideToggle()" rel="tooltip" title="" class="btn btn-white btn-link btn-sm" data-original-title="Edit Comments">
            <i class="material-icons">edit</i>
            </button>
            @include('backend.shared.buttons.delete' , ['row' => $comment])
            </td>
        </tr>
        <tr style="display:none">
            <td collapse="2">
                <form action="{{ route('comments.update' , ['id' => $comment]) }}" method="POST">
                    @csrf
                    @include('backend.comments.form' , ['row' => $comment])
                    <input type="hidden" name="_method" value="put"/>
                    <input type="hidden" name="video_id" value="{{ $row->id}}" />
                    <button type="submit" class="btn btn-primary pull-right">Update Comment</button>
                    <div class="clearfix"></div>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>