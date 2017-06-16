
@extends('layouts.app')

@section('content')
    <div class="add-comic-step-1">
        <div class="add-comic-step-1__content">
            <div class="add-comic-step-1__title">
                <h2 class="title title_theme_header title_center">New comic | Basic</h2>
            </div>
            <form action="/comic/create-1" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="add-comic-step-1__grid">
                    <div class="add-comic-step-1__col add-comic-step-1__col_1">
                        <div class="add-comic-step-1__button">
                            @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'cover'])

                            <label class="button button_theme_add-cover" for="cover">
                                <img width="100%" class="cropped-img" alt="" role="presentation" src=""
                                        />
                                <svg class="button__i-add"><use xlink:href="/images/icon.svg#icon_plus"></use></svg>
                                <svg class="button__i-refresh-main"><use xlink:href="/images/icon.svg#icon_ongoing"></use></svg>
                                <span class="button__text">Add Cover</span>
                            </label>
                            <input type="hidden" name="cover" class="img-field" />
                            <input type="file" id="cover" class="img-upload-input" />
                        </div>
                        <div class="add-comic-step-1__extra-covers">
                            <div class="add-comic-step-1__description">
                                <svg class="add-comic-step-1__i-info"><use xlink:href="/images/icon.svg#icon_info"></use></svg>
                                <p class="description description_theme_info">You can also provide extra covers which will be visible in your comic profile:</p>
                            </div>
                            <div class="add-comic-step-1__button add-comic-step-1__button_size_s">
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'cover'])

                                <label href="#" class="button button_theme_add-cover" for="cover-1">
                                    <img width="100%" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="cropped-img"
                                         alt="" role="presentation" />
                                    <svg class="button__i-add"><use xlink:href="/images/icon.svg#icon_plus"></use></svg>
                                    <svg class="button__i-refresh"><use xlink:href="/images/icon.svg#icon_ongoing"></use></svg>
                                    <svg class="button__i-delete"><use xlink:href="/images/icon.svg#icon_trash"></use></svg>
                                </label>
                                <input type="hidden" name="extra-cover[]" class="img-field" />
                                <input type="file" id="cover-1" class="img-upload-input" />
                            </div>
                        </div>
                        <a href="#upload-cover" id="upload-cover-form" data-effect="mfp-zoom-in" class="img-upload-link"></a>
                        <div class="crop-popup">
                            <div id="upload-cover" class="upload-cover">
                                <div class="upload-cover__title">
                                    <h2 class="title title_theme_header">Edit comic thumbnails</h2>
                                </div>
                                <div class="upload-cover__description">
                                    <p class="description description_theme_header">This thumbnails will be used as comic thumbnails.</p>
                                </div>
                                <div class="upload-cover__crop-wrapper">
                                    <div class="upload-cover__crop-img">
                                        <img class="upload-cover__img" alt="" role="presentation" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
                                                />
                                    </div>
                                    <div class="upload-cover__previews">
                                        <div class="upload-cover__col upload-cover__col_1">
                                            <div class="upload-cover__preview"></div>
                                        </div>
                                        <div class="upload-cover__col upload-cover__col_2">
                                            <div class="upload-cover__preview"></div>
                                            <div class="upload-cover__col upload-cover__col_3">
                                                <div class="upload-cover__preview"></div>
                                            </div>
                                        </div>
                                        <div class="upload-cover__col upload-cover__col_2">
                                            <div class="upload-cover__button">
                                                <a href="#" class="button button_theme_bubble-gum button_size_l" id="save-cover">Save</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="add-comic-step-1__col add-comic-step-1__col_3">
                        <div class="add-comic-step-1__field">
                            @if(session('success'))
                                <div class="alert alert_theme_success">
                                    <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_success"></use></svg>
                                    <div class="alert__msg">{{session('success')}}</div>
                                    <svg class="alert__close"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                                </div>
                            @endif
                            <div class="field field_font_l">{{-- field_theme_error--}}
                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'title'])

                                <input type="text" maxlength="255" name="title" value="{{old('title')}}" placeholder="Title" class="field__input" />
                            </div>
                            {{--<div class="alert alert_theme_error">
                                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_error"></use></svg>
                                <div class="alert__msg">Some Error message</div>
                                <svg class="alert__close"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                            </div>
                            <div class="alert alert_theme_warning">
                                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_warning"></use></svg>
                                <div class="alert__msg">Some Warning message</div>
                                <svg class="alert__close"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                            </div>
                            <div class="alert alert_theme_info">
                                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_info"></use></svg>
                                <div class="alert__msg">Some Info message</div>
                                <svg class="alert__close"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                            </div>
                            <div class="alert alert_theme_success">
                                <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_success"></use></svg>
                                <div class="alert__msg">Some Success message</div>
                                <svg class="alert__close"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                            </div>--}}
                        </div>
                        <div class="add-comic-step-1__select">
                            @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'comic_status'])

                            <div class="select select_theme_light select_font_l" id="statuses">
                                <select style="width: 100%" class="select__select-hidden" name="comic_status">
                                    @foreach ($comicStatuses as $comicStatus)
                                        <option value="{{$comicStatus->id}}" {{ (old('comic_status') == $comicStatus->id) ? 'selected' : '' }}>{{$comicStatus->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="add-comic-step-1__select">
                            @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'genres'])

                            <div class="select select_theme_light select_font_l" id="genres">
                                <select multiple="multiple" style="width: 100%" class="select__select-hidden"  name="genres[]">
                                    @foreach ($genres as $genre)
                                        <option class="select__option-hidden" value="{{$genre->id}}" {{( old('genres') == $genre->id ) ? 'selected' : '' }}>{{$genre->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!--+e.selected-genres+genres(getData('genres'))._theme_add-->
                        <div class="add-comic-step-1__textarea">
                            @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'description'])

                            <textarea placeholder="Description"  name="description" class="textarea textarea_font_l">{{old('description')}}</textarea>
                        </div>
                        <div class="add-comic-step-1__checkbox">
                            <div class="checkbox">
                                <input type="checkbox" id="single" name="single" class="checkbox__input" {{ (old('single')) ? 'selected' : ''}}/>
                                <label for="single" class="checkbox__label">Single</label>
                            </div>
                        </div>
                        <div class="add-comic-step-1__checkbox">
                            <div class="checkbox">
                                <input type="checkbox" id="mature" name="adult_content" class="checkbox__input" {{ (old('adult_content')) ? 'selected' : ''}}/>
                                <label for="mature" class="checkbox__label">Contains mature content</label>
                            </div>
                        </div>
                        <div class="add-comic-step-1__controls">
                            <div class="controls controls_left">
                                <a href="/profile" class="button button_theme_bubble-gum-light button_size_l">Cancel</a>
                                <button type="submit" class="button button_theme_bubble-gum button_size_l"> Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection