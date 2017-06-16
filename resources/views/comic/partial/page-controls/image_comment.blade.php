<div class="comments__comment">
    <div class="comment">
		<span class="comment__user">
		    <span class="user user_size_s user_theme_dark">
			    <a href="/profile/{{$comment->user->id}}" class="avatar">
                    <img src="{{get_s3_bucket().get_avatar_path('s').$comment->user->image}}" class="avatar__image" alt="{{$comment->user->name}}" role="presentation"/>
                </a>
				<a href="/profile/{{$comment->user->id}}" class="user__username">{{$comment->user->name}}:</a>
			</span>
        </span>
        <span class="comment__text">{!! nl2br(e($comment->content)) !!}</span>
        <div
                class="comment__more comment__more_inline">
            <div class="more">
                <div class="more__button">
                    <svg class="more__i-more"><use xlink:href="/images/icon.svg#icon_more"></use></svg>
                </div>
                <div class="more__menu more__menu_hidden">
                    <ul class="menu menu_theme_more">
                        <li class="menu__wrapper">
                            <ul>
                                <li class="menu__item">
                                    <a href="#" class="link">Block user</a>
                                </li>
                                <li class="menu__item">
                                    <a href="#" class="link">Hide comment</a>
                                </li>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>