@include('errors.partial.validation', ['errors'=>$errors, 'name'=>'email'])

<div class="tab-block__head">Account</div>
<div class="tab-block__content">
    <form method="POST" action="/settings" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="tab" value="{{$activeTab}}" class="custom-control-input">

        <div class="tab-block__grid">
            <div class="tab-block__col tab-block__col_col_3">
                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'name'])

                <div class="tab-block__label">Name</div>

                <div class="tab-block__field">
                    <div class="field">
                        <input type="text" name="name" value="{{ (!empty(old('name'))) ?  old('name') : $user->name }}" placeholder="Name" class="field__input" />
                    </div>
                </div>
                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'password'])

                <div class="tab-block__label">Password</div>
                <div class="tab-block__field">
                    <div class="field">
                        <input type="password" name="password_current" placeholder="Old Password" class="field__input" />
                    </div>
                </div>
                <div class="tab-block__field">
                    <div class="field field_radius-top">
                        <input type="password" name="password_confirmation" placeholder="New Password" class="field__input" />
                    </div>
                    <div class="field field_radius-bottom">
                        <input type="password" name="password" placeholder="Repeat Password" class="field__input" />
                    </div>
                </div>
                <div class="tab-block__label">About me</div>
                <div class="tab-block__textarea">
                    <textarea placeholder="About me" name="about" class="textarea textarea_font_m">
                        {{ (!empty(old('about'))) ? old('about') : $user->about }}
                    </textarea>
                </div>
                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'city'])

                <div class="tab-block__label">City</div>
                <div class="tab-block__field">
                    <div class="field">
                        <input type="text" name="city" value="{{ (!empty(old('city'))) ? old('city') : $user->city }}" placeholder="City" class="field__input" />
                    </div>
                </div>
                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'country'])

                <div class="tab-block__label">Country</div>
                <div class="tab-block__select">
                    <div class="select select_theme_light" id="countries">
                        <select style="width: 100%" class="select__select-hidden" name="country">
                            @if (!empty($countries))
                                @foreach ($countries as $country)
                                    <option class="select__option-hidden" value="{{$country->id}}"
                                    @if (old('country') == $country->id || $user->country_id == $country->id)
                                            selected
                                            @endif
                                            >{{$country->name}}
                                    </option>
                                @endforeach
                            @endif                                                </select>
                    </div>
                </div>

            </div>
            <div class="tab-block__col tab-block__col_col_1">
                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'cover'])

                <div class="tab-block__label">Avatar</div>
                <div class="tab-block__avatar-wrapper">
                    <div class="tab-block__avatar">
                        <div class="avatar avatar_size_xl">
                            <img src="{{get_s3_bucket().get_avatar_path('xl').Auth::user()->image}}" class="avatar__image" alt="{{$user->name}}" role="presentation" />
                        </div>
                        <!--+b.IMG(width="100%",height="100%", src="/images/avatar.png").cropped-img-->
                    </div>
                    <input type="hidden" name="avatar" class="img-field" />
                    <input type="file" id="avatar" class="img-upload-input" />
                </div>
                <label href="#" class="button button button_theme_bubble-gum-light button_size_s" for="avatar">Upload Avatar</label>
                <a href="#upload-avatar" id="upload-avatar-form" data-effect="mfp-zoom-in" class="img-upload-link"></a>
                <div class="crop-popup">
                    <div id="upload-avatar" class="upload-avatar">
                        <div class="upload-avatar__title">
                            <h2 class="title title_theme_header">Edit avatar thumbnails</h2>
                        </div>
                        <div class="upload-avatar__crop-wrapper">
                            <div class="upload-avatar__crop-img">
                                <img class="upload-avatar__img" alt="" role="presentation" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                        />
                            </div>
                            <div class="upload-avatar__previews">
                                <div class="upload-avatar__col">
                                    <div class="upload-avatar__row upload-avatar__row_1">
                                        <div class="upload-avatar__preview"></div>
                                    </div>
                                    <div class="upload-avatar__row upload-avatar__row_2">
                                        <div class="upload-avatar__preview"></div>
                                    </div>
                                    <div class="upload-avatar__row upload-avatar__row_3">
                                        <div class="upload-avatar__preview"></div>
                                    </div>
                                    <div class="upload-avatar__row upload-avatar__row_4">
                                        <div class="upload-avatar__preview"></div>
                                    </div>
                                    <div class="upload-avatar__button">
                                        <a href="#" class="button button_theme_bubble-gum button_size_l" id="save-avatar">Save</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-block__button">
            <button type="submit" class="button button_theme_bubble-gum button_size_s">
                <svg class="button__i-save"><use xlink:href="/images/icon.svg#icon_save"></use></svg>Save</button>
        </div>
    </form>
</div>