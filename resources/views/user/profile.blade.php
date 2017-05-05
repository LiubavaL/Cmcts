@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset(session('activationMailSent')))
            <div class="alert alert-success alert-block">
                Письмо с подтверждением было выслано на почту.
            </div>
        @endif
        @if(isset(session('activated')) && session('activated') == true)
            <div class="alert alert-success alert-block">
                Ваш профиль успешно активирован!
            </div>
        @elseif(!empty($user->is_verified))
            <div class="alert alert-danger alert-block">
                Ваш аккаунт уже активирован.
            </div>
        @elseif
            <div class="alert alert-danger alert-block">
                Не удалось активировать аккаунт! Попробуйте повторно отправить письмо с подтверждением.
            </div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-block">
                        <img style="border-radius: 5px" src="/storage/profile/{{$user->image}}" alt="{{$user->name}}" width="100" height="100">
                        <h3>{{$user->name}}</h3>
                        @if(!empty($user->country_id))
                            <p class="card-text">
                                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                <small>{{$user->country->name}}</small>
                            </p>
                        @endif
                        @if($user->id != Auth::id())
                                @if ($isFollowing)
                                    <form method="POST" action="/profile/{{$user->id}}/unfollow">
                                        <button type="sumbit" class="btn btn-danger">Не отслеживать</button>
                                @else
                                    <form method="POST" action="/profile/{{$user->id}}/follow">
                                        <button type="sumbit" class="btn btn-success">Отслеживать</button>
                                @endif
                                     {{ csrf_field() }}
                                </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Опубликованные работы</h3></div>
                    <ul class="list-group">
                        @foreach ( $comics as $comic )
                            <li class="list-group-item">
                                <h5 id="contents">
                                    <a class="anchorjs-link " href="/comic/{{$comic->slug}}">
                                        {{ $comic->title }}
                                    </a>
                                </h5>
                                <img src="{{'/images/'.$comic->cover}}" width="300" height="auto"/>
                                <span class="badge badge-default badge-pill">{{ $comic->status->title }}</span>
                            </li>
                        @endforeach
                    </ul>

                </div>@if($comics->count() == 0)
                    <p  class="panel-heading">Пользователь пока не публиковал свои работы.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
