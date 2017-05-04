<div class="card">
    <div class="card-header p-b-0">
        <img src="{{get_avatar_path().$comment->user->image}}">
        <h5 class="card-title"> {{$comment->user->name}}</h5>
    </div>

    <div class="card-block">
        <p class="card-text">{{$comment->content}}</p>
        <p><button class="btn btn-secondary">Ответить</button></p>
    </div>
</div>