@extends('layouts.auth')

@section('content')
<div class="signin">
    <div class="signin__title">
        <h2 class="title title_theme_auth">Log in to
            <svg class="title__i-logo"><use xlink:href="assets/images/icon.svg#icon_logo"></use></svg>
        </h2>
    </div>
    <form role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'email'])
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'password'])

        <div class="signin__field">
            <div class="field field_radius-top {{ $errors->has('email') ? ' field_error' : '' }}">
                <input type="email" value="{{ old('email') }}" name="email" placeholder="example@mail.com" class="field__input" autofocus/>
            </div>
            <div class="field field_radius-bottom">
                <input type="password" value="" name="password" placeholder="Password" class="field__input" />
            </div>
            <a href="{{ url('/password/reset') }}" title="Forgot password?" class="signin__forgot">
                <svg class="signin__i-forgot"><use xlink:href="assets/images/icon.svg#icon_question"></use></svg>
            </a>
        </div>
        <div class="signin__controls">
            <button type="submit" class="button button_theme_bubble-gum button_size_s">Sign In</button>
            <div class="signin__checkbox">
                <div class="checkbox">
                    <input type="checkbox" id="remember" class="checkbox__input" name="remember" {{ old('remember') ? 'checked' : ''}}/>
                    <label for="remember" class="checkbox__label">Remember Me</label>
                </div>
            </div>
        </div>
        <div class="signin__separator"></div>
        <div class="signin__label">
            First time on Comicats?
            <a href="{{ url('/register') }}" class="button button_theme_bubble-gum-link">Sign Up</a> for free now!
        </div>
    </form>
</div>
@endsection
