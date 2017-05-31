@extends('layouts.app')
@section('content')
    <div class="popular">
        <div class="popular__content">
            <div class="popular__title">
                <h2 class="title title_theme_header">Popular</h2>
                <div class="select select_theme_dark select_size_m">
                    <select style="width: 100%" class="select__select-hidden">
                        <option value="1 day" class="select__option-hidden">1 day</option>
                    </select>
                </div>
            </div>
            <div class="popular__grid">
                @foreach($popularComics->splice(0, 3) as $popularComic)
                    @if($authUser->show_adult || !$popularComic->adult_content)
                        @include('comic.partial.preview.l', ['comic' => $popularComic, 'user' => $popularComic->user])
                    @endif
                @endforeach
                @foreach($popularComics as $popularComic)
                    @if($authUser->show_adult || !$popularComic->adult_content)
                        @include('comic.partial.preview.m', ['comic' => $popularComic, 'user' => $popularComic->user])
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection