<div class="comments__comment">
    <div class="comment">
        <a href="/profile/{{$comment->user->id}}" class="avatar avatar_size_m">
            <img src="{{get_s3_bucket().get_avatar_path('m').$comment->user->image}}" class="avatar__image" alt="{{$comment->user->name}}" role="presentation" />
        </a>
        <div class="comment__content">
            <div class="comment__head">
                <div class="comment__title">
                    <a href="/profile/{{$comment->user->id}}" class="title title_theme_name">{{$comment->user->name}}</a>
                </div>
                <div class="comment__date">{{Date::humanFormat($comment->created_at)}}</div>
            </div>
            <div class="comment__text">{!! nl2br(e($comment->content)) !!}</div>
        </div>
    </div>
</div>
