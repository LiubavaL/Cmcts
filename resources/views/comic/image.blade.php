@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="grid-example">
            <div class="row">
                <div class="col-sm-12">{{$comic->title}}</div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <select class="custom-select">
                        @foreach ($comic->volumes as $volume)
                            @foreach ($volume->chapters as $chapter)
                                <option
                                        @if ($volumeSequence == $volume->sequence
                                            && $chapterSequence == $chapter->sequence)
                                            selected
                                        @endif
                                        value="/{{$comic->slug.'/'.$volume->sequence.'/'.$chapter->sequence}}">
                                    Том {{$volume->sequence}}. Глава {{$chapter->sequence}} - {{$chapter->title}}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <a href="/comic/{{$comic->slug}}@if($prevPage){{'/'.$prevPage['volume'].'/'.$prevPage['chapter'].'/'.$prevPage['image']}}@endif" class="btn btn-secondary">Назад</a>

                    <select class="custom-select">
                        @foreach ($chapterImages as $image)
                            <option @if ($imageSequence == $image->sequence) selected @endif
                                value="/{{$comic->slug.'/'.$volumeSequence.'/'.$chapterSequence.'/'.$image->sequence}}">
                                {{$image->sequence}}
                            </option>
                        @endforeach
                    </select>

                    <a href="/comic/{{$comic->slug}}@if($nextPage){{'/'.$nextPage['volume'].'/'.$nextPage['chapter'].'/'.$nextPage['image']}}@endif" class="btn btn-secondary">Вперед</a>
                </div>
            </div>
        </div>
        @forelse ($chapterImages as $image)
            @if ($image->sequence == $imageSequence)
                <img src="{{get_comicpage_path($image->name).$image->name}}" width="100%" height="auto"/>

                @forelse($image->image_comments as $comment)
                    @include('comic.partial.image_comment', ['comment'=>$comment])
                @empty
                    <h3>Комментариев нет.</h3>
                @endforelse

                <form action="/comment/add" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$image->id}}">
                    <textarea name="comment"></textarea>

                    <button type="submit">Добавить</button>
                </form>
            @endif
        @empty
            <div class="grid-example">
                <div class="row">
                    <div class="col-sm-12">
                        <h2>Страницы не найдены.</h2>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection