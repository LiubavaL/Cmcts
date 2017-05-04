@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    @if(session('success'))
                        <div class="alert alert-success alert-block">
                            {{session('success')}}
                        </div>
                    @endif

                    <div class="panel-heading" data-example-id="">
                        <ul class="nav nav-tabs">
                            <li @if ($activeTab == 'general')
                                class="active"
                                    @endif ><a  href="/settings/general">Общие</a></li>
                            <li @if ($activeTab == 'account')
                                class="active"
                                    @endif><a  href="/settings/account">Аккаунт</a></li>
                            <li @if ($activeTab == 'notifications')
                                class="active"
                                    @endif><a  href="/settings/notifications">Уведомления</a></li>
                            <li @if ($activeTab == 'blacklist')
                                class="active"
                                    @endif><a  href="/settings/blacklist">Черный список</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="general" class="tab-pane fade
                            @if ($activeTab == 'general')
                                in active
                            @endif
                                    ">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-example-id="">
                                        <div class="form-group">
                                            @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'email'])
                                            <h5>Email</h5>
                                            <form method="POST" action="/settings/general">
                                                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                                       aria-describedby="emailHelp" placeholder="Email"
                                                       value="{{ (!empty(old('email'))) ? old('email') : $user->email }}">
                                                <small id="emailHelp" class="form-text text-muted">
                                                    Ваша почта не будет доступна другим пользователям.
                                                </small>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-example-id="">
                                        <div class="form-group">
                                            <h5>Контент для взрослых</h5>
                                            <form method="POST" action="/settings">
                                            {{--<label class="custom-control custom-checkbox">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="tab" value="{{$activeTab}}" class="custom-control-input">
                                                    <input type="checkbox" name="show_adult" class="custom-control-input"
                                                    @if ($user->show_adult)
                                                        selected
                                                    @endif
                                                    >

                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Отображать контент для взрослых</span>
                                                    <button type="submit" class="btn btn-primary">Изменить</button>

                                            </label>--}}
                                            <label class="form-check-labexl">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="tab" value="{{$activeTab}}" >
                                                <input type="checkbox" name="show_adult" class="form-check-input"
                                                @if ($user->show_adult)
                                                       checked
                                                @endif
                                                        >
                                                <span style="margin-left: 20px">Отображать контент для взрослых</span>
                                            </label>
                                            <div>
                                                <button type="submit" class="btn btn-primary">Изменить</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="account" class="tab-pane fade
                            @if ($activeTab == 'account')
                                in active
                            @endif">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-example-id="">
                                        <form method="POST" action="/settings" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="tab" value="{{$activeTab}}" class="custom-control-input">
                                            <div class="panel panel-default">
                                                <div class="panel-heading" data-example-id="">
                                                    <div class="form-group">
                                                        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'name'])

                                                        <h5>Имя</h5>
                                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                                                               aria-describedby="emailHelp" placeholder="Имя"
                                                               value="{{ (!empty(old('name'))) ?  old('name') : $user->name }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" data-example-id="">

                                                    <div class="form-group">
                                                        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'cover'])
                                                        <h5>Обложка</h5>
                                                        <img src="{{get_avatar_path().Auth::user()->image}}" width="100"
                                                             height="auto">
                                                        <input type="file" name="cover" value="{{old('cover')}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" data-example-id="">
                                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'password'])
                                                    <div class="form-group">
                                                        <h5>Смена пароля</h5>
                                                        <input type="password" name="password_current" class="form-control"
                                                               id="exampleInputPassword1"
                                                               placeholder="Текущий пароль">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password_confirmation" class="form-control"
                                                               id="exampleInputPassword1"
                                                               placeholder="Новый пароль">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" class="form-control"
                                                               id="exampleInputPassword1"
                                                               placeholder="Повторите новый пароль">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" data-example-id="">
                                                    <div class="form-group">
                                                        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'city'])
                                                        <h5>Город</h5>
                                                        <input type="text" name="city" class="form-control"
                                                               id="exampleInputPassword1"
                                                               placeholder="Город"
                                                               value="{{ (!empty(old('city'))) ? old('city') : $user->city }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default">
                                                <div class="panel-heading" data-example-id="">
                                                    <div class="form-group">
                                                        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'country'])
                                                        <h5>Страна</h5>
                                                        <select name="country" class="form-control">
                                                            @if (!empty($countries))
                                                                @foreach ($countries as $country)
                                                                    <option value="{{$country->id}}"
                                                                        @if (old('country') == $country->id || $user->country_id == $country->id)
                                                                            selected
                                                                        @endif
                                                                            >{{$country->name}}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Изменить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div id="notifications" class="tab-pane fade
                            @if ($activeTab == 'notifications')
                                in active
                            @endif">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-example-id="">
                                        <p>Настройки уведомлений.</p>
                                    </div>
                                </div>
                            </div>
                            <div id="blacklist" class="tab-pane fade
                            @if ($activeTab == 'blacklist')
                                in active
                            @endif">
                                <div class="panel panel-default">
                                    <div class="panel-heading" data-example-id="">
                                        <form method="POST" action="/blacklist/add">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'block_user'])
                                                <h5>Черный список</h5>
                                                <textarea name="block_user" class="form-control" rows="3"></textarea>
                                                <small id="emailHelp" class="form-text text-muted">Введите имя
                                                    пользователя,
                                                    которого хотите внести в черный список.
                                                </small>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Добавить</button>
                                        </form>
                                        <ul class="list-group">
                                            @foreach ($user->blacklist as $blockedUser)
                                                <li class="list-group-item justify-content-between">
                                                    {{$blockedUser->name}}
                                                    <form method="POST" action="/blacklist/remove">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="user_id" value="{{$blockedUser->id}}"/>
                                                        <button type="submit" class="badge badge-default badge-pill">Удалить</button>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
