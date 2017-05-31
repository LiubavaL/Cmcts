<div class="comments__comment">
    <div class="comment">
		<span class="comment__user">
		    <span class="user user_size_s user_theme_dark">
			    <a href="/profile/{{$comment->user->id}}" class="avatar">
                    <img src="{{get_s3_bucket().get_avatar_path('s').$comment->user->image}}" class="avatar__image" alt="{{$comment->user->name}}" role="presentation"/>
                </a>
				<a href="/profile/{{$comment->user->id}}" class="user__username">{{$comment->user->name}}</a>
			</span>
        </span>
        <span class="comment__text">{!! nl2br(e($comment->content)) !!}</span>
    </div>
</div>