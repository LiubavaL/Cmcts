@extends('layouts.app')
@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_EN/sdk.js#xfbml=1&version=v2.9";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <div class="comic-profile">
        <div class="comic-profile__head-slider">
            <div class="slider-pro">
                <div class="slides">
                    @forelse($comic->extra_covers as $extraCover)
                        <div class="slides__slide">
                            <img src="{{get_s3_bucket().get_s3_cover_path('extra').$extraCover->image}}" class="sp-image" alt="{{ $comic->title }}" role="presentation" />
                        </div>
                    @empty
                    <div class="slides__slide">
                            <img src="{{get_s3_bucket().get_s3_cover_path('extra').'wM6pDyGmdxE.png'}}" class="sp-image" alt="{{ $comic->title }}" role="presentation" />
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="comic-profile__overlay">
                <div class="comic-profile__head">
                    <div class="comic-profile__title">
                        <h1 class="title title_theme_comic-promo">{{$comic->title}}</h1>
                    </div>
                    <div class="comic-profile__author">
                        <span class="comic-profile__text">by</span>
                        <div class="user user_size_s user_theme_light">
                            <a href="/profile/{{ $comic->user->id }}" class="avatar">
                                <img src="{{get_s3_bucket().get_avatar_path('s').$comic->user->image}}" class="avatar__image" alt="{{ $comic->user->name }}" role="presentation" />
                            </a>
                            <a href="/profile/{{ $comic->user->id }}" class="user__username">{{ $comic->user->name }}</a>
                        </div>
                    </div>
                    <div class="comic-profile__buttons">
                        <input type="hidden" name="cid" value="{{$comic->id}}">@if(!$isSelfComic)
                            @if($isSubscribed)
                                @include('comic.partial.subscribe.unsubscribe')
                            @else
                                @include('comic.partial.subscribe.subscribe')
                            @endif
                        @endif
                        <a
                        @if($comic->volumes->first()->sequence !== 0)
                            href="/comic/{{$comic->slug}}/1/1/1"
                        @else
                            href="/comic/{{$comic->slug}}/0/1/1"
                        @endif
                            class="button button_theme_bubble-gum button_size_l">Start Reading</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="comic-profile__info">
            <div class="comic-profile__col comic-profile__col_col_2-3">
                <div class="comic-profile__description">
                    <p class="description description_theme_comic-promo"> {!! nl2br(e($comic->description)) !!}</p>
                </div>
                @if($comic->adult_content)
                    <div class="comic-profile__alert">
                        <div class="alert alert_theme_warning">
                            <svg class="alert__icon"><use xlink:href="/images/icon.svg#icon_alert"></use></svg>
                            <div class="alert__msg">This comic contains mature content.</div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="comic-profile__col comic-profile__col_col_1-3">
                <div class="comic-profile__reactions">
                    <div class="reactions">
                        @if($hasLike || $isSelfComic)
                            <input type="hidden" name="hasLike" value="{{$hasLike}}">
                        @endif
                        @include('comic.partial.reactions.happy', ['hasLike' => $hasLike, 'likeCount' => $comic->likesCount->pull('1')])
                        @include('comic.partial.reactions.wondering', ['hasLike' => $hasLike, 'likeCount' => $comic->likesCount->pull('2')])
                        @include('comic.partial.reactions.sad', ['hasLike' => $hasLike, 'likeCount' => $comic->likesCount->pull('3')])
                    </div>
                </div>
                <div class="comic-profile__genres">
                    <div class="genres genres_theme_comic-promo">
                        @foreach($comic->genres as $genre)
                            <a href="#" class="genre">{{$genre->title}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="comic-profile__stat">
                    <div class="comic-profile__stat-row">
                        <div class="comic-profile__stat-row-l">Total Rating</div>
                        <div class="comic-profile__stat-row-r">{{Count::formatFull($comic->rating)}}</div>
                    </div>
                    <div class="comic-profile__stat-row">
                        <div class="comic-profile__stat-row-l">Views</div>
                        <div class="comic-profile__stat-row-r">{{Count::formatFull($comic->views)}}</div>
                    </div>
                    <div class="comic-profile__stat-row">
                        <div class="comic-profile__stat-row-l">Subscribtions</div>
                        <div class="comic-profile__stat-row-r">{{Count::formatFull($comic->subscribers_count)}}</div>
                    </div>
                    <div class="comic-profile__stat-row">
                        <div class="comic-profile__stat-row-l">Status</div>
                        <div class="comic-profile__stat-row-r comic-profile__stat-row-r_theme_status">
                            @include('comic.partial.status.status', ['status' => $comic->status])
                        </div>
                    </div>
                </div>
                <div class="comic-profile__share">

                    <a href="http://www.facebook.com/sharer/sharer.php?u={{Request::url()}}&title={{$comic->title}}" target="_blank" class="comic-profile__share-link">
                        <svg class="comic-profile__i-share  comic-profile__i-share_fb"><use xlink:href="/images/icon.svg#icon_fb"></use></svg>
                    </a>

                    <a class="comic-profile__share-link twitter-share-button"
                       href="https://twitter.com/intent/tweet?text={{$comic->title}}&url={{Request::url()}}&hashtags=comicats,comic,{{$comic->title}}" target="_blank"
                       data-size="small">
                        <svg class="comic-profile__i-share comic-profile__i-share_tw"><use xlink:href="/images/icon.svg#icon_twitter"></use></svg>
                    </a>

                    <a href="https://plus.google.com/share?url={{Request::url()}}" target="_blank" class="comic-profile__share-link">
                        <svg class="comic-profile__i-share comic-profile__i-share_g"><use xlink:href="/images/icon.svg#icon_google"></use></svg>
                    </a>

                    <a href="https://vk.com/share.php?url={{Request::url()}}" target="_blank" class="comic-profile__share-link">
                        <svg class="comic-profile__i-share comic-profile__i-share_vk"><use xlink:href="/images/icon.svg#icon_vk"></use></svg>
                    </a>

                </div>
                <div class="comic-profile__release">Added on {{date_format($comic->created_at, 'F d, Y')}}</div>
                @if($isSelfComic)
                    <div class="comic-profile__controls">
                        <a href="/comic/{{$comic->slug}}/edit" class="button button_theme_gray-light button_size_xs">Edit</a>
                        <span class="comic-profile__delimeter">/&nbsp&nbsp</span>
                        <a href="#delete-comic" class="button button_theme_bubble-gum-light button_size_xs" id="delete-comic-form"
                           data-effect="mfp-zoom-in">Delete</a>
                        <div class="comic-profile__delete-comic">
                            <div id="delete-comic" class="delete-comic">
                                <h2 class="title title_theme_header">Delete comic</h2>
                                <div class="delete-comic__title">
                                    <h2 class="title">Are you sure you want to delete comic?</h2>
                                </div>
                                <div class="controls">
                                    <a href="#" class="button button_theme_gray-light button_size_m" id="close">
                                        <span class="button__text">Cancel</span>
                                    </a>
                                    <a href="#" class="button button_theme_bubble-gum-light button_size_m" id="delete">
											<span class="button__loader" style="display:none">
												<span class="loader loader_size_s loader_hidden">
													<span class="loader__circle-group">
														<span id="circle_1" class="loader__circle loader__circle_1"></span>
														<span id="circle_2" class="loader__circle loader__circle_2"></span>
														<span id="circle_3" class="loader__circle loader__circle_3"></span>
													</span>
												</span>
											</span>
                                        <span class="button__text">Delete</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="comic-profile__chapters">
            <div class="comic-profile__content">
                <div class="comic-profile__title">
                    <h2 class="title title_theme_header">Chapters</h2>
                </div>
                @include('comic.partial.content-tree.content', ['comic' => $comic])
            </div>
        </div>
        <div class="comic-profile__foot">
            <div class="comic-profile__responces">
                <div class="comic-profile__title">
                    <h2 class="title title_theme_header">Responces</h2>
                </div>
                <div class="comments comments_theme_responces">
                    @forelse($comic->comments as $comment)
                        @include('comic.partial.responces.responce', ['comment' => $comment])
                    @empty
                        <div class="comments__none" style="margin-top: 10px; color: #bbb">No comments yet.</div>
                    @endforelse
                    @if(!empty($authUser))
                        <div class="comments__comment" id="responce">
                            <div class="comment">
                                <a href="/profile/{{$authUser->id}}" class="avatar avatar_size_m">
                                    <img src="{{get_s3_bucket().get_avatar_path('m').$authUser->image}}" class="avatar__image" alt="{{$authUser->name}}" role="presentation" />
                                </a>
                                <div class="comment__content">
                                    <div class="comment__head">
                                        <div class="comment__title">
                                            <a href="/profile/{{$authUser->id}}" class="title title_theme_name">{{$authUser->name}}</a>
                                        </div>
                                    </div>
                                    <div class="comment__add">
                                        <input type="hidden" name="cid" value="{{$comic->id}}"/>
                                        <textarea name="responce" placeholder="What was your impressions? " class="comment__textarea"></textarea>
                                        <div class="comment__button">
                                            <a href="#" id="add-responce" class="button button_theme_bubble-gum button_size_s">
                                                <span class="button__loader button_hidden">
                                                    <span class="loader loader_size_s">
                                                        <span class="loader__circle-group">
                                                            <span id="circle_1" class="loader__circle loader__circle_1"></span>
                                                            <span id="circle_2" class="loader__circle loader__circle_2"></span>
                                                            <span id="circle_3" class="loader__circle loader__circle_3"></span>
                                                        </span>
                                                    </span>
                                                </span>
                                                <span class="button__text">Post</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="comic-profile__similar">
                <div class="comic-profile__title">
                    <h2 class="title title_theme_header">Similar</h2>
                </div>
                <div class="comic-profile__grid">
                    @forelse($relatedComics as $relatedComic)
                        @include('comic.partial.preview.m', ['comic' => $relatedComic, 'user' => $relatedComic->user])
                    @empty
                        <p>No similar comics are found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection