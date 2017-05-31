@extends('layouts.app')

@section('content')
    <div class="about">
        <div class="about__promo">
            <div class="promo promo_theme_bubble-gum">
                <div class="promo__title">
                    <h2 class="title title_theme_about">About COMICATS</h2>
                </div>
                <p class="description description_theme_promo">Place for your comics</p>
            </div>
        </div>
        <div class="about__content">
            <div class="about__description">
                <p class="description description_theme_about">What are you creating? COMICATS is a community of comic creators answering that question each day. Hobbyst and professional
                    comic creators share their works here.COMICATS is a place to show and tell, promote, discover, and explore comics.Founded
                    in 2016, COMICATS began as a side project and is now a Tiny, bootstrapped and profitable company helping the world’s
                    design talent share their creations. COMICATS has become a go-to resource for discovering and connecting with comicsists
                    around the globe.</p>
            </div>
        </div>
        <div class="about__team">
            <div class="about__title">
                <h2 class="title title_theme_header">Team COMICATS</h2>
            </div>
            <div class="about__grid">
                <div class="about__col about__col_3">
                    <div class="about__avatar">
                        <a href="#" class="avatar avatar_size_xl">
                            <img src="/images/81fgnP9EdyL.jpg" class="avatar__image" alt="" role="presentation" />
                        </a>
                    </div>
                    <div class="about__name">
                        <h2 class="title title_theme_team">Liuba Vitko</h2>
                    </div>
                    <div class="about__role">founder & developer</div>
                </div>
                <div class="about__col about__col_3">
                    <div class="about__avatar">
                        <a href="#" class="avatar avatar_size_xl">
                            <img src="/images/4339394-batman+and+robin+01.jpg" class="avatar__image" alt="" role="presentation" />
                        </a>
                    </div>
                    <div class="about__name">
                        <h2 class="title title_theme_team">Angelina Fkntsu</h2>
                    </div>
                    <div class="about__role">head of sales & marketing</div>
                </div>
                <div class="about__col about__col_3">
                    <div class="about__avatar">
                        <a href="#" class="avatar avatar_size_xl">
                            <img src="/images/3044acc8e0fdedfe3172e0208b1af135.jpg" class="avatar__image" alt="" role="presentation" />
                        </a>
                    </div>
                    <div class="about__name">
                        <h2 class="title title_theme_team">Anna Bondareva</h2>
                    </div>
                    <div class="about__role">product design</div>
                </div>
            </div>
        </div>
    </div>
@endsection