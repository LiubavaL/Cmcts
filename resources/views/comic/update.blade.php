
@extends('layouts.app')

@section('content')
    <div class="edit-comic">
    <div class="edit-comic__tabs">
        <div class="edit-comic__heading">
            <div class="edit-comic__tab">
                <a href="#basic" class="button button_theme_edit-tab button_uppercase button_theme_edit-tab_active">
                    <span class="button__text">General</span>
                </a>
            </div>
            <div class="edit-comic__separator">|</div>
            <div class="edit-comic__tab">
                <a href="#chapters" class="button button_theme_edit-tab button_uppercase">
                    <span class="button__text">Chapters</span>
                </a>
            </div>
        </div>
        <div id="basic" class="edit-comic__tab-content edit-comic__tab-content_active">
            <div class="add-comic-step-1">
                <div class="add-comic-step-1__content">
                    @include('comic.partial.update.general', ['comic'=>$comic])
                </div>
            </div>
        </div>
        <div id="chapters" class="edit-comic__tab-content">
            <div class="add-comic-step-2">
                <div class="add-comic-step-2__content add-comic-step-2__content_main">
                    @include('comic.partial.update.chapters', ['comic'=>$comic])
                </div>
            </div>
        </div>

        <div class="add-comic-step-1__controls">
            <div class="controls controls_left">
                <a href="#" class="button button_theme_bubble-gum-light button_size_l">
													<span class="button__loader button_hidden">
														<span class="loader loader_size_s">
															<span class="loader__circle-group">
																<span id="circle_1" class="loader__circle loader__circle_1"></span>
																<span id="circle_2" class="loader__circle loader__circle_2"></span>
																<span id="circle_3" class="loader__circle loader__circle_3"></span>
															</span>
														</span>
													</span>
                    <span class="button__text">Cancel</span>
                </a>
                <a href="#" class="button button_theme_bubble-gum button_size_l">
													<span class="button__loader button_hidden">
														<span class="loader loader_size_s">
															<span class="loader__circle-group">
																<span id="circle_1" class="loader__circle loader__circle_1"></span>
																<span id="circle_2" class="loader__circle loader__circle_2"></span>
																<span id="circle_3" class="loader__circle loader__circle_3"></span>
															</span>
														</span>
													</span>
                    <svg class="button__i-save"><use xlink:href="/images/icon.svg#icon_save"></use></svg>
                    <span class="button__text">Save</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection