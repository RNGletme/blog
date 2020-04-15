@if(Auth::id() != $id)
    @if(Auth::user()->star($id)->exists())
    <button class="btn btn-default like-button" like-value="0" like-user="{{ $id }}" type="button">取消关注</button>
    @else
    <button class="btn btn-default like-button" like-value="1" like-user="{{ $id }}" type="button">关注</button>
    @endif
@endif
