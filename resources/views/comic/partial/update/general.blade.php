<div class="add-comic-step-1__grid">
    <div class="add-comic-step-1__col add-comic-step-1__col_1">
        <div class="add-comic-step-1__button">
            <div class="add-comic-step-1__button add-comic-step-1__button_filled">
                <label class="button button_theme_add-cover" for="cover">
                    <img width="100%" class="cropped-img" alt="{{$comic->title}}" role="presentation" src="{{get_s3_bucket().get_s3_cover_path('l').$comic->cover}}">
                    <svg class="button__i-add"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_plus"></use></svg>
                    <svg class="button__i-refresh-main"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="/images/icon.svg#icon_ongoing"></use></svg>
                    <span class="button__text">Add Cover</span>
                </label>
                <input type="hidden" name="cover" class="img-field" value="">
                <input type="file" id="cover" class="img-upload-input">
            </div>
        </div>
        <div class="add-comic-step-1__extra-covers">
            <div class="add-comic-step-1__description">
                <svg class="add-comic-step-1__i-info"><use xlink:href="/images/icon.svg#icon_info"></use></svg>
                <p class="description description_theme_info">You can also provide extra covers which will be visible in your comic profile:</p>
            </div>
            @foreach($comic->extra_covers as $extraCover)
                @include('comic.partial.update.extra-cover', ['extraCover'=>$extraCover])
            @endforeach
            @include('comic.partial.update.extra-cover', ['extraCover'=> null])
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
                                <a href="#" class="button button_theme_bubble-gum button_size_l" id="save-cover">
																	<span class="button__loader">
																		<span class="loader loader_size_s">
																			<span class="loader__circle-group">
																				<span id="circle_1" class="loader__circle loader__circle_1"></span>
																				<span id="circle_2" class="loader__circle loader__circle_2"></span>
																				<span id="circle_3" class="loader__circle loader__circle_3"></span>
																			</span>
																		</span>
																	</span>
                                    <span class="button__text">Save</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="add-comic-step-1__col add-comic-step-1__col_3">
        <div class="add-comic-step-1__field">
            <div class="field field_font_l field_theme_error">
                <input type="text" value="{{$comic->title}}" placeholder="Title" class="field__input" />
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
            <div class="select select_theme_light select_font_l" id="statuses">
                <select style="width: 100%" class="select__select-hidden">
                    @foreach ($comicStatuses as $comicStatus)
                        <option value="{{$comicStatus->id}}" {{ ($comic->status_id == $comicStatus->id) ? 'selected' : '' }}>{{$comicStatus->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="add-comic-step-1__select">
            <div class="select select_theme_light select_font_l" id="genres">
                <select multiple="multiple" style="width: 100%" class="select__select-hidden">
                    @foreach ($genres as $genre)
                        <option class="select__option-hidden" value="{{$comic->hasGenre($genre->id)}}" {{( $comic->hasGenre($genre->id)) ? 'selected' : '' }}>{{$genre->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--+e.selected-genres+genres(getData('genres'))._theme_add-->
        <div class="add-comic-step-1__textarea">
            <textarea placeholder="Description" class="textarea textarea_font_l">{{$comic->description}}</textarea>
        </div>
        <div class="add-comic-step-1__checkbox">
            <div class="checkbox">
                <input type="checkbox" id="single" class="checkbox__input" {{( $comic->single ) ? 'checked' : '' }}/>
                <label for="single" class="checkbox__label">Single</label>
            </div>
        </div>
        <div class="add-comic-step-1__checkbox">
            <div class="checkbox">
                <input type="checkbox" id="mature" class="checkbox__input" {{( $comic->adult_content ) ? 'checked' : '' }}/>
                <label for="mature" class="checkbox__label">Contains mature content</label>
            </div>
        </div>
    </div>
</div>