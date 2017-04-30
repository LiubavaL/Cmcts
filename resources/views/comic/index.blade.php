@extends('layouts.app')
@section('content')
<div class="container">

    <div class="grid-example">
        <div class="row">
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">{{$comic->title}}</h4>
                        <img src="{{'/images/'.$comic->cover}}" width="100%" height="auto"/>
                        <hr/>
                        <p class="card-text">{{ $comic->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                    @if ($comic->user_id != Auth::id())
                            @if ($hasLike)
                                <form method="POST" action="/comic/{{$comic->slug}}/dislike">
                                    <button type="sumbit" class="btn btn-danger">Не нравится</button>
                            @else
                                <form method="POST" action="/comic/{{$comic->slug}}/like">
                                    <button type="sumbit" class="btn btn-success">Нравится</button>
                            @endif
                                    {{ csrf_field() }}
                                </form>
                            <button type="button" class="btn btn-warning">В закладки</button>
                            <hr/>
                    @endif
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                    @foreach ( $comic->volumes as $volume )
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse_{{$volume->id}}" aria-expanded="false" aria-controls="collapse_{{$volume->id}}" class="collapsed">
                                        Том - {{$volume->title}}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapse_{{$volume->id}}" class="collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false">
                                <div class="card-block">
                                    <ul>
                                        @foreach ( $volume->chapters as $chapter )
                                            <li>
                                                <a href="/comic/{{$comic->slug}}/{{$volume->sequence}}/{{$chapter->sequence}}/1" id="markdown-toc-textual-inputs"> -
                                                    {{$chapter->title}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection