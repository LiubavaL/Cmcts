@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Популярные
                <small>за все время</small>
            </h1>
        </div>
    </div>

               {{-- <div class="panel-body">
                    You are logged in!
                    Yoyr role is {{Auth::user()->roles->first()->name}}
                </div>--}}

    @foreach ($comics->chunk(3) as $comicChunk)
        <div class="row">
            @foreach ($comicChunk as $comic)
                @include('comic.partial.preview', ['comic' => $comic])
            @endforeach
        </div>
    @endforeach
</div>
@endsection
