
<div class="tab-block__head">Blocked Users</div>
<div class="tab-block__content">
    <div class="tab-block__text">Add username you want to block:</div>
    <form method="POST" action="/blacklist/add">
        {{ csrf_field() }}
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'block_user'])

        <div class="tab-block__field">
            <div class="field field_size_l">
                <input type="text" name="block_user" placeholder="Username" class="field__input" />
            </div>
            <div class="tab-block__button tab-block__button_inline">
                <button type="submit" class="button button_theme_bubble-gum button_size_s">Add</button>
            </div>
        </div>
    </form>
    <div class="tab-block__grid" style='flex-direction: column'>
        @if($user->blacklist->count() > 0 )
            <div class="tab-block__heading">User</div>
        @endif
        <div class="tab-block__body">
            @foreach ($user->blacklist as $blockedUser)
                <div class="tab-block__row">
                    <div class="tab-block__user">
                        <div class="user user_size_s user_theme_dark">
                            <a href="/profile/{{$blockedUser->id}}" class="avatar">
                                <img src="{{get_s3_bucket().get_avatar_path('s').$blockedUser->image}}" class="avatar__image" alt="{{$blockedUser->name}}" role="presentation"
                                        />
                            </a>
                            <a href="/profile/{{$blockedUser->id}}" class="user__username">{{$blockedUser->name}}</a>
                        </div>
                    </div>
                    <form method="POST" action="/blacklist/remove">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$blockedUser->id}}"/>

                        <button type="submit" class="tab-block__remove">
                            <svg class="tab-block__i-remove"><use xlink:href="/images/icon.svg#icon_trash"></use></svg>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</div>