<div class="search__result-item">
    <div class="search__col">
        <img src="{{get_s3_bucket().get_s3_cover_path('l').$comic->cover}}" class="search__cover" alt="{{$comic->title}}" role="presentation"
                />
    </div>
    <div class="search__col">
        <div class="search__title">
            <h2 class="title title_theme_comic">{{$comic->title}}</h2>
        </div>
        {{--<div class="search__author">--}}
            {{--<div class="user user_size_s user_theme_dark">--}}
                {{--<a href="/profile/{{$comic->user->id}}" class="avatar">--}}
                    {{--<img src="{{get_avatar_path().$comic->user->image}}" class="avatar__image" alt="{{$comic->user->name}}" role="presentation" />--}}
                {{--</a>--}}
                {{--<a href="/profile/{{$comic->user->id}}" class="user__username">{{$comic->user->name}}</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="search__type">Comic</div>
    </div>
</div>