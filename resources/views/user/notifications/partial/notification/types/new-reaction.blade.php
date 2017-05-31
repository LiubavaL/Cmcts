<div class="notification__icon">
    <svg class="notification__i-fav"><use xlink:href="/images/icon.svg#icon_comics"></use></svg>
</div>
<div class="notification__content">
    <a href="/profile/{{$notification->data['rater_id']}}" class="button button_theme_bubble-gum-link">{{$notification->data['rater_name']}}</a>
    <span class="notification__text">reacted on your comic</span>
    <a href="/comic/{{$notification->data['comic_slug']}}" class="button button_theme_bubble-gum-link">{{$notification->data['comic_title']}}</a>
</div>