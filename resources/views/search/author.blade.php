<div class="search__result-item">
    <div class="search__col">
        <img src="{{get_s3_bucket().get_avatar_path('s').$author->image}}" class="search__avatar" alt="{{$author->name}}" role="presentation" />
    </div>
    <div class="search__col">
        <div class="search__title">
            <h2 class="title title_theme_comic">{{$author->name}}</h2>
        </div>
        <div class="search__type">Author</div>
    </div>
</div>