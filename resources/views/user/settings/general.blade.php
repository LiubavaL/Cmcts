<div class="tab-content__tab-block">
    <div class="tab-block">
        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'email'])

        @if(!$user->is_verified && !session('activationMailSent'))
            <div class="alert alert_theme_warning">
                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_alert"></use></svg>
                <div class="alert__msg">Your Email is not activated. <a href="/activate"> Activate now</a>.</div>
            </div>
        @endif

        @if(!$user->is_verified && session('activationMailSent'))
            <div class="alert alert_theme_success">
                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_success"></use></svg>
                <div class="alert__msg">Activation link has been sent to {{$user->email}}.</div>
            </div>
        @endif

        @if($user->is_verified && session('activated'))
            <div class="alert alert_theme_success">
                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_success"></use></svg>
                <div class="alert__msg">Your account has been succesfly activated!</div>
            </div>

        @elseif( session('activated') === false)
            <div class="alert alert_theme_error">
                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_error"></use></svg>
                <div class="alert__msg">Incorrect activation link, failed to activate account.</div>
            </div>
        @endif

        <div class="tab-block__head">Email</div>
        <form method="POST" action="/settings">
            {{ csrf_field() }}
            <input type="hidden" name="tab" value="{{$activeTab}}" >
            <div class="tab-block__content">
                <div class="tab-block__field">
                    <div class="field">
                        <input type="email" name="email" value="{{ (!empty(old('email'))) ? old('email') : $user->email }}" placeholder="example@mail.com" class="field__input" />
                    </div>
                </div>
                <div class="tab-block__button">
                    <button type="submit" class="button button_theme_bubble-gum button_size_s">
                        <svg class="button__i-save"><use xlink:href="/images/icon.svg#icon_save"></use></svg>Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="tab-block">
    <div class="tab-block__head">Adult Content</div>
    <form method="POST" action="/settings">
        {{ csrf_field() }}
        <input type="hidden" name="tab" value="{{$activeTab}}" >
        <div class="tab-block__content">
            <div class="tab-block__checkbox">
                <div class="checkbox">
                    <input type="checkbox" name="show_adult" id="adult" class="checkbox__input"
                           @if ($user->show_adult)
                               checked
                           @endif/>
                    <label for="adult" class="checkbox__label">Show adult content</label>
                </div>
            </div>
            <div class="tab-block__button">
                <button type="submit" class="button button_theme_bubble-gum button_size_s">
                    <svg class="button__i-save"><use xlink:href="/images/icon.svg#icon_save"></use></svg>Save</button>
            </div>
        </div>
    </form>
</div>