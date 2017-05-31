@extends('layouts.auth')

@section('content')
<div class="signup">
    <div class="signup__title">
        <h2 class="title title_theme_auth">Join
            <svg class="title__i-logo"><use xlink:href="assets/images/icon.svg#icon_logo"></use></svg>
        </h2>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
        {{ csrf_field() }}
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'name'])
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'email'])
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'password'])
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'password_confirmation'])

        <div class="signup__field">
            <div class="field {{ $errors->has('name') ? ' field_error' : '' }}">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Login" class="field__input" autofocus/>
            </div>
        </div>
        <div class="signup__field">
            <div class="field {{ $errors->has('email') ? 'field_error' : '' }}">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" class="field__input" />
            </div>
        </div>
        <div class="signup__field">
            <div class="field field_radius-top {{ $errors->has('password') ? 'field_error' : '' }}">
                <input type="password" name="password" placeholder="Password" class="field__input" />
            </div>
            <div class="field field_radius-bottom">
                <input type="password" name="password_confirmation" placeholder="Repeat Password" class="field__input" />
            </div>
        </div>
        <div class="signup__controls">
            <button type="submit" class="button button_theme_bubble-gum button_size_s">Sign Up</button>
        </div>
        <div class="signup__separator"></div>
        <div class="signup__label">Already have an account?
        <a href="{{ url('/login') }}" class="button button_theme_bubble-gum-link">Log In</a>
    </div>
    </form>
</div>
@endsection
