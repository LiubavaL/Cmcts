@extends('layouts.app')

@section('content')
<div class="signup">
    <div class="signup__title">
        <h2 class="title title_theme_auth">Restore Password</h2>
    </div>
    @if (session('status'))
        <div class="alert alert_theme_success">
            {{ session('status') }}
        </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="signup__field">
            <div class="field">
                <input type="email" name="email" value="{{ $email or old('email') }}" placeholder="example@mail.com" class="field__input" required autofocus/>
            </div>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
        <div class="signup__field">
            <div class="field field_radius-top {{ $errors->has('password') ? 'field_error' : '' }}">
                <input type="password" name="password" placeholder="New Password" class="field__input" required/>
            </div>
            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
            <div class="field field_radius-bottom {{ $errors->has('password_confirmation') ? 'field_error' : '' }}">
                <input type="password"  name="password_confirmation" placeholder="Repeat Password" class="field__input" required/>
            </div>
            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
            @endif
        </div>
        <div class="signup__controls">
        <button type="submit"  class="button button_theme_bubble-gum button_size_s">Reset Password</button>
    </div>
    </form>
</div>
@endsection
