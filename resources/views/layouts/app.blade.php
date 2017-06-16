<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="imagetoolbar" content="no">
    <meta name="msthemecompatible" content="no">
    <meta name="cleartype" content="on">
    <meta name="HandheldFriendly" content="True">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <meta name="google" value="notranslate">
    <meta name="theme-color" content="#ffffff">
    <link rel="manifest" href="/manifest.json">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="keywords" content="comics,art,drawing,gallery">
    @if(Route::currentRouteName() == 'show-comic')
        <meta property="og:url"           content="{{Request::url()}}" />
        <meta property="og:type"          content="comic" />
        <meta property="og:title"         content="{{$comic->title}}" />
        <meta property="og:description"   content="{{$comic->description}}" />
        <meta property="og:image"         content="{{get_s3_bucket().get_s3_cover_path('m').$comic->cover}}" />
        <meta name="twitter:title" content="{{$comic->title}}">
        <meta name="twitter:description" content="{{$comic->description}}">
        <meta name="twitter:image" content="{{get_s3_bucket().get_s3_cover_path('m').$comic->cover}}">
        <meta name="twitter:card" content="summary_large_image">

        <!--  Non-Essential, But Recommended -->
        <meta property="og:site_name" content="{{ config('app.name', 'Laravel') }}">
        <meta name="twitter:image:alt" content="Comic {{$comic->title}}">
    @endif

        <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/css/app.min.css" rel="stylesheet">

        <script src="https://apis.google.com/js/platform.js" async defer>
            {lang: 'en'}
        </script>
        <script type="text/javascript" src="https://vk.com/js/api/share.js?94" charset="windows-1251"></script>

</head>

<body class="page">
<header class="header">
    <div class="header__content">
        <nav class="header__nav">
            <a href="{{ url('/') }}" class="header__link">
                <svg class="logo"><use xlink:href="/images/icon.svg#icon_logo"></use></svg>
            </a>
            <div class="header__menu">
                <ul class="menu menu_theme_header">
                    <li class="menu__wrapper">
                        <ul>
                            <li class="menu__item
                            @if(Route::currentRouteName() == 'popular')
                             menu__item_active
                            @endif
                            ">
                                <a href="/popular" class="link">Popular</a>
                            </li>
                            <li class="menu__item
                            @if(Route::currentRouteName() == 'ongoing')
                             menu__item_active
                            @endif
                            ">
                                <a href="/ongoing" class="link">Ongoing</a>
                            </li>
                            <li class="menu__item
                            @if(Route::currentRouteName() == 'new')
                             menu__item_active
                            @endif">
                                <a href="/new" class="link">New</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="header__profile-t">
            @if (Auth::guest())
                <a href="/login" class="button button_theme_bubble-gum button_size_xs">Sign&nbsp;In</a>
            @else
                <a href="#search" id="search-form" data-effect="mfp-move-from-top" class="header__link-t">
                    <svg class="header__icon"><use xlink:href="/images/icon.svg#icon_search"></use></svg>
                </a>
                <a
                    @if(isset($userComics) && $userComics->count() > 0)
                        href="#add-comic" id="add-comic-form" data-effect="mfp-zoom-in"
                    @else
                        href="/comic/create-1"
                    @endif
                     class="header__link-t">
                    <svg class="header__icon"><use xlink:href="/images/icon.svg#icon_add_2"></use></svg>
                </a>
                <a href="#" id="show-feed" class="header__link-t">
                    <svg class="header__icon"><use xlink:href="/images/icon.svg#icon_feed"></use></svg>
                    @if(!empty($unreadNotifications))
                        <span class="new-label"></span>
                    @endif
                </a>
                <div class="header__feed">
                    <div class="feed feed_invisible">
                        <div class="feed__loader feed_hidden">
                            <div class="loader loader_size_s">
                                <div class="loader__circle-group">
                                    <div id="circle_1" class="loader__circle loader__circle_1"></div>
                                    <div id="circle_2" class="loader__circle loader__circle_2"></div>
                                    <div id="circle_3" class="loader__circle loader__circle_3"></div>
                                </div>
                            </div>
                        </div>
                            <div class="feed__items">
                                <div class="feed__all">
                                    <a href="/notifications" class="button button button_theme_gray-link">View All</a>
                                </div>
                            </div>
                            {{--<div class="feed__none">No new Notifications.
                        </div>--}}
                    </div>
                </div>
                <div class="header__profile-dd">
                <div class="profile-dd">
                    <a href="#" class="profile-dd__avatar">
                        <img src="{{get_s3_bucket().get_avatar_path('l').Auth::user()->image}}" alt="{{ Auth::user()->name }}" class="profile-dd__image" role="presentation" />
                    </a>
                    <div class="profile-dd__profile-menu">
                        <ul class="menu menu_theme_profile">
                            <li class="menu__wrapper">
                                <ul>
                                    <li class="menu__item">
                                        <a href="/profile" class="link">{{ Auth::user()->name }}</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="/settings/general" class="link">Settings</a>
                                    </li>
                                    <li class="menu__item">
                                        <a href="/logout" class="link"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    </li>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="header__search">
        <div id="search" class="search">
            <div class="search__field">
                <div class="field field_font_xl">
                    <input type="text" name="search" placeholder="Search for Author or Comic" class="field__input" />
                </div>
                <div class="search__loader" style="display: none">
                    <div class="loader loader_size_l">
                        <div class="loader__circle-group">
                            <div id="circle_1" class="loader__circle loader__circle_1"></div>
                            <div id="circle_2" class="loader__circle loader__circle_2"></div>
                            <div id="circle_3" class="loader__circle loader__circle_3"></div>
                        </div>
                    </div>
                </div>
                <div class="search__result-list">

                </div>
            </div>
        </div>
    </div>
    <div class="header__add-comic">
        <div id="add-comic" class="add-comic">
            <div class="add-comic__grid">
                <div class="add-comic__col">
                    <a href="{{url('comic/create-1')}}" class="add-comic__link">
                        <svg class="add-comic__i-create"><use xlink:href="/images/icon.svg#icon_add_2"></use></svg>
                        <h2 class="title title_theme_header">Add New Comic</h2>
                    </a>
                </div>
                <div class="add-comic__col add-comic__col_mid">
                    <div class="add-comic__text">or</div>
                </div>
                <div class="add-comic__col">
                    <a href="#" class="add-comic__link">
                        <svg class="add-comic__i-update"><use xlink:href="/images/icon.svg#icon_comics"></use></svg>
                        <h2 class="title title_theme_header">Update Comic</h2>
                    </a>
                    <div class="select select_theme_light select_size_l">
                        <select id="update-comic" style="width: 100%" class="select__select-hidden">
                            @if(!empty($userComics))
                                @foreach($userComics as $userComic)
                                    <option value="{{url('comic/'.$userComic->slug.'/update')}}" data-image="{{get_s3_bucket().get_s3_cover_path('s').$userComic->cover}}" class="select__option-hidden">{{$userComic->title}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<main class="container" role="main">
    @yield('content')
</main>
<footer class="footer">
    <div class="footer__content">
        <div class="footer__menu">
            <ul class="menu menu_theme_footer">
                <li class="menu__wrapper">
                    <ul>
                        <li class="menu__item">
                            <a href="/about" class="link">About</a>
                        </li>
                        <li class="menu__item">
                            <a href="/help" class="link">Help</a>
                        </li>
                        <li class="menu__item">
                            <a href="/contact" class="link">Contact</a>
                        </li>
                        <li class="menu__item">
                            <a href="/terms" class="link">Terms</a>
                        </li>
                </li>
            </ul>
        </div>
        <div class="footer__about">
            <div class="footer__col">
                <div class="footer__logo">
                    <svg class="logo"><use xlink:href="/images/icon.svg#icon_logo"></use></svg>
                    <div class="footer__text">Place for your comics.</div>
                </div>
            </div>
            <div class="footer__col">
                <div class="footer__promo">Are you captivated by creating comics? Comicats is a community of comic lovers sharingtheir lovely painted stories.</div>
            </div>
            <div class="footer__col footer__col_centered">
                <div class="footer__comicats">
                    <div class="comicats">
                        <span class="comicats__number">34</span>
                        <span class="comicats__text">COMICATS uploaded</span>
                    </div>
                </div>
                <div class="footer__copyright">All artworks © their owners.</div>
            </div>
        </div>
    </div>
</footer>
<div class="loader-overlay loader-overlay_hidden">
    <div class="loader-overlay__loader">
        <div class="loader loader_size_l">
            <div class="loader__circle-group">
                <div id="circle_1" class="loader__circle loader__circle_1"></div>
                <div id="circle_2" class="loader__circle loader__circle_2"></div>
                <div id="circle_3" class="loader__circle loader__circle_3"></div>
            </div>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="/js/app.min.js"></script>
<script src="/js/ajax.js"></script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-98862533-1', 'auto');
    ga('send', 'pageview');

</script>
</body>

</html>

