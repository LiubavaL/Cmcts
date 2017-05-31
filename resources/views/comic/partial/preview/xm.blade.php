@if (!empty($comic))
<div class="preview-card preview-card_size-xm" style="background: url('{{get_s3_bucket().get_s3_cover_path('l').$comic->cover}}')">
    <div class="preview-card__overlay">
        <div class="preview-card__top">
            <a href="/comic/{{$comic->slug}}" class="preview-card__title">{{$comic->title}}</a>
            <div class="preview-card__genres">
                <div class="genres genres_theme_promo">
                    @foreach ($comic->genres as $genre)
                        <a href="#" class="genre">{{$genre->title}}</a>
                    @endforeach
                </div>
            </div>
            <div class="preview-card__author">
                <div class="user user_theme_dark user_size_s">
                    <a href="/profile/{{$user->id}}" class="avatar">
                        <img src="{{get_s3_bucket().get_avatar_path('s').$user->image}}" class="avatar__image" alt="{{$user->name}}" role="presentation"
                                />
                    </a>
                    <a href="/profile/{{$user->id}}" class="user__username">{{$user->name}}</a>
                </div>
            </div>
        </div>
        <div class="preview-card__bottom">
            @include('comic.partial.preview.bottom', ['comic' => $comic, 'user' => $user])
        </div>
    </div>
</div>
@endif

