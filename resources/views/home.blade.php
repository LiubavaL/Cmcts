@extends('layouts.app')

@section('content')
    <div class="index">
        @if (Auth::guest())
            <div class="index__promo">
                <div class="promo promo_theme_bubble-gum">
                    <svg class="promo__close"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                    <div class="promo__title">
                        <h2 class="title title_theme_promo">Best place for comic creators</h2>
                    </div>
                    <p class="description description_theme_promo">Wanna all the world to see your story?&nbsp;
                        <a href="/register" class="button button_theme_white-light">Sign&nbsp;Up</a>&nbsp;&nbsp;now for free!</p>
                </div>
            </div>
        @endif
        <div class="index__popular">
            <div class="index__title">
                <h2 class="title title_theme_header">Popular</h2>
            </div>
            <div class="index__grid">
                <div class="index__col col-2">
                    <div class="index__preview-card">
                        @include('comic.partial.preview.l', ['user' => $popularComics[0]->user, 'comic' => $popularComics->shift()])
                    </div>
                </div>
                <div class="index__col col-2">
                    <div class="index__row">
                        @foreach($popularComics->splice(0, 2) as $popularComic)
                            @include('comic.partial.preview.m', ['comic' => $popularComic, 'user' => $popularComic->user])
                        @endforeach
                    </div>
                    <div class="index__row">
                        @foreach($popularComics->splice(0, 2) as $popularComic)
                            @include('comic.partial.preview.m', ['comic' => $popularComic, 'user' => $popularComic->user])
                        @endforeach
                    </div>
                </div>
                <div class="index__col col-2">
                    <div class="index__row">
                        @foreach($popularComics->splice(0, 3) as $popularComic)
                            @include('comic.partial.preview.s', ['comic' => $popularComic, 'user' => $popularComic->user])
                        @endforeach
                    </div>
                    <div class="index__row">
                        @foreach($popularComics->splice(0, 3) as $popularComic)
                            @include('comic.partial.preview.s', ['comic' => $popularComic, 'user' => $popularComic->user])
                        @endforeach
                    </div>
                    <div class="index__row">
                        @foreach($popularComics->splice(0, 2) as $popularComic)
                            @include('comic.partial.preview.s', ['comic' => $popularComic, 'user' => $popularComic->user])
                        @endforeach
                        <div class="index__preview-card">
                            <a href="/popular" class="button button_theme_more button_theme_more_size_s">more
                                <svg class="button__i-more"><use xlink:href="/images/icon.svg#icon_arrow"></use></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="index__new">
            <div class="index__title">
                <h2 class="title title_theme_header">New</h2>
            </div>
            <div class="index__grid index__grid_type_new index__grid_hidden">
                @foreach($newComics as $newComic)
                    <div class="index__preview-card">
                        @include('comic.partial.preview.s', ['comic' => $newComic, 'user' => $newComic->user])
                    </div>

                @endforeach
                <div class="index__preview-card">
                    <a href="/new" class="button button_theme_more button_theme_more_size_s">more
                        <svg class="button__i-more"><use xlink:href="/images/icon.svg#icon_arrow"></use></svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="index__ongoing">
            <div class="index__title">
                <h2 class="title title_theme_header">Latest Releases</h2>
            </div>
            <div class="index__grid index__grid_type_ongoing">
                @foreach($ongoingComics->chunk(6) as $ongoingComicChunk)
                    <div class="index__row">
                        @foreach ($ongoingComicChunk as $ongoingComic)
                            @include('comic.partial.preview.m', ['comic' => $ongoingComic, 'user' => $ongoingComic->user])
                        @endforeach
                    </div>
                @endforeach
                <div class="index__preview-card">
                    <a href="/ongoing" class="button button_theme_more button_theme_more_size_m">more
                        <svg class="button__i-more"><use xlink:href="/images/icon.svg#icon_arrow"></use></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
