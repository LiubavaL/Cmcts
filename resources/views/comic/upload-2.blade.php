@extends('layouts.app')

@section('content')
    <div class="add-comic-step-2">
        <div class="add-comic-step-2__content add-comic-step-2__content_main">
            <div class="add-comic-step-2__title">
                <h2 class="title title_theme_header title_center">New comic | Chapters</h2>
            </div>
            <form action="/comic/create-2" enctype="multipart/form-data" method="POST">
                {{ csrf_field() }}
                <div class="add-comic-step-2__fields">
                    <div class="add-comic-step-2__chapters add-comic-step-2__chapters_hidden">
                        <div class="add-comic-step-2__chapter add-comic-step-2__chapter_hidden">
                            <div class="add-comic-step-2__root">
                                <svg class="add-comic-step-2__i-chapter"><use xlink:href="/images/icon.svg#icon_chapter"></use></svg>
                                <div class="add-comic-step-2__label">Chapter</div>
                                <div class="add-comic-step-2__field">
                                    <div class="field">
                                        @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.0.title'])

                                        <input type="text" value="{{old('volume.0.chapter.0.title')}}" placeholder="Chapter title (optional)" class="field__input" />
                                    </div>
                                </div>
                                <svg class="add-comic-step-2__i-delete"><use xlink:href="/images/icon.svg#icon_trash"></use></svg>
                                <div class="add-comic-step-2__button">
                                    @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.0.chapter_images'])
                                    <input type="file" class="add-comic-step-2__file" />
                                    <label href="#" class="button button_theme_bubble-gum-light button_height_s">
                                        <svg class="button__i-page"><use xlink:href="/images/icon.svg#icon_page"></use></svg>
                                        <span>Add Page(s)</span>
                                    </label>
                                </div>
                                <span class="add-comic-step-2__filename"></span>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="button button_theme_gray-light button_size_xl" id="add-chapter">
                        <svg class="button__i-chapter"><use xlink:href="/images/icon.svg#icon_chapter"></use></svg>Add chapter</a>
                    <div class="add-comic-step-2__or">OR</div>
                    <div class="add-comic-step-2__volumes add-comic-step-2__volumes_hidden">
                        <div class="add-comic-step-2__volume add-comic-step-2__volume_hidden">
                            <div class="add-comic-step-2__root">
                                <svg class="add-comic-step-2__i-volume"><use xlink:href="/images/icon.svg#icon_comics"></use></svg>
                                <div class="add-comic-step-2__label add-comic-step-2__label_volume">Volume 1</div>
                                <div class="add-comic-step-2__field">
                                    <div class="field">
                                        <input type="text" value="{{old('volume.0.title')}}" name="volume[0][title]" placeholder="Volume title (optional)" class="field__input" />
                                    </div>
                                </div>
                                <svg class="add-comic-step-2__i-delete"><use xlink:href="/images/icon.svg#icon_trash"></use></svg>
                            </div>
                            <div class="add-comic-step-2__body">
                                <div class="add-comic-step-2__chapters add-comic-step-2__chapters_hidden">
                                    <div class="add-comic-step-2__chapter add-comic-step-2__chapter_hidden">
                                        <div class="add-comic-step-2__root">
                                            <svg class="add-comic-step-2__i-chapter"><use xlink:href="/images/icon.svg#icon_chapter"></use></svg>
                                            <div class="add-comic-step-2__label">Chapter 1</div>
                                            <div class="add-comic-step-2__field add-comic-step-2__field_chapter">
                                                <div class="field">
                                                    <input type="text" value="{{old('volume.0.chapter.0.title')}}" placeholder="Chapter title (optional)" class="field__input" />
                                                </div>
                                            </div>
                                            <svg class="add-comic-step-2__i-delete"><use xlink:href="/images/icon.svg#icon_close"></use></svg>
                                            <div class="add-comic-step-2__button">
                                                @include('errors.partial.validation', ['errors'=>$errors, 'name'=>'volume.0.chapter.0.chapter_images'])
                                                <input type="file" class="add-comic-step-2__file" />
                                                <label href="#" class="button button_theme_bubble-gum-light button_height_s">
                                                    <svg class="button__i-page"><use xlink:href="/images/icon.svg#icon_page"></use></svg>
                                                    <span>Add Page(s)</span>
                                                </label>
                                            </div>
                                            <span class="add-comic-step-2__filename"></span>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="button button_theme_gray-light button_size_l button_add-chapter">
                                    <svg class="button__i-chapter"><use xlink:href="/images/icon.svg#icon_chapter"></use></svg>Add chapter</a>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="button button_theme_gray button_size_xl" id="add-volume">
                        <svg class="button__i-volume"><use xlink:href="/images/icon.svg#icon_comics"></use></svg>Add volume</a>
                </div>
                <div class="add-comic-step-2__controls">
                <div class="controls controls_centered">
                    <a href="/comic/create-1" class="button button_theme_bubble-gum-light button_size_l">Back</a>
                    <button id="upload" type="submit" class="button button_theme_bubble-gum button_size_l">Upload</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection