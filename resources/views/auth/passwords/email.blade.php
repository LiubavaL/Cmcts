@extends('layouts.auth')

<!-- Main Content -->
@section('content')
<div class="signup">
    <div class="signup__title">
        <h2 class="title title_theme_auth">Restore Password</h2>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
        <div class="signup__field">
            <div class="field">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="example@mail.com" class="field__input" required/>
            </div>
        </div>
        <div class="signup__controls">
            <button type="submit" class="button button_theme_bubble-gum">Send Password Reset Link</button>
        </div>
    </form>
</div>
@endsection
