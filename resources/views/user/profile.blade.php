@extends('layouts.app')

@section('content')

    <div class="profile">
        <div class="profile__content">
            <div class="profile__info-wrapper">
                <div class="profile__info">
                    <div class="profile__avatar">
                        <div class="avatar avatar_size_xl">
                            <img src="{{get_s3_bucket().get_avatar_path('xl').$user->image}}" class="avatar__image" alt="{{$user->name}}" role="presentation" />
                        </div>
                    </div>
                    <div class="profile__username">{{$user->name}}</div>
                    @if(!empty($user->country_id) && !empty($user->city))
                        <div class="profile__location">
                            <div class="location">
                                <svg class="location__i-location"><use xlink:href="/images/icon.svg#icon_location"></use></svg>
                                <span class="location__text">
                                    @if(!empty($user->city))
                                        {{$user->city}}
                                    @endif
                                    @if(!empty($user->country_id))
                                    , {{$user->country->name}}
                                    @elseif(!empty($user->city))
                                    , Unknown
                                    @endif
                                </span>
                            </div>
                        </div>
                    @endif
                    <div class="profile__stat">
                        <div class="profile__col">
                            <div class="profile__button">
                                <a href="/profile/{{$user->id}}/followers" class="button button_theme_bubble-gum-link button_uppercase">Followers</a>
                            </div>
                            <div class="profile__count">{{$followers}}</div>
                        </div>
                        <div class="profile__col">
                            <div class="profile__button">
                                <a href="/profile/{{$user->id}}/following" class="button button_theme_bubble-gum-link button_uppercase">Following</a>
                            </div>
                            <div class="profile__count">{{$following}}</div>
                        </div>
                    </div>
                    <div class="profile__about">{{$user->about}}</div>
                    <div class="profile__follow">
                        @if($user->id != Auth::id())
                            @if ($isFollowing)
                                <form method="POST" action="/profile/{{$user->id}}/unfollow">
                                    <button type="sumbit" class="button button_theme_gray-light button_size_xs button_uppercase">Unfollow</button>
                            @else
                                <form method="POST" action="/profile/{{$user->id}}/follow">
                                    <button type="sumbit" class="button button_theme_bubble-gum-light button_size_xs button_uppercase">Follow</button>
                            @endif
                                    {{ csrf_field() }}
                                </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="profile__comics">
                <div class="profile__tabs">
                    <div class="profile__heading">
                        <div class="profile__tab">
                            <a href="#comics" class="button button_theme_gray-link">
                                <svg class="button__i-volume"><use xlink:href="/images/icon.svg#icon_comics"></use></svg>My Comics</a>
                        </div>
                        <div class="profile__separator">|</div>
                        <div class="profile__tab">
                            <a href="#subscriptions" class="button button_theme_gray-light-link">
                                <svg class="button__i-volume"><use xlink:href="/images/icon.svg#icon_favorites"></use></svg>Subscribed</a>
                        </div>
                    </div>
                    <div id="comics" class="profile__tab-content profile__tab-content_active">
                        @include('user.partial.profile-grid', ['comics' => $comics, '$isSelfProfile' => $isSelfProfile, 'user' => $user, 'addable' => true])
                    </div>
                    <div id="subscriptions" class="profile__tab-content">
                        @include('user.partial.profile-grid', ['comics' => $user->subscriptions, '$isSelfProfile' => $isSelfProfile, 'user' => $user, 'addable' => false])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
