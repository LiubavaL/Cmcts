<div class="notification__icon">
    <svg class="notification__i-fav"><use xlink:href="/images/icon.svg#icon_favorites"></use></svg>
</div>
<div class="notification__content">
    <a href="/profile/{{$notification->data['subscriptor_id']}}" class="button button_theme_bubble-gum-link">{{$notification->data['subscriptor_name']}}</a>
    <span class="notification__text">subscribed your comic</span>
    <a href="/comic/{{$notification->data['comic_slug']}}" class="button button_theme_bubble-gum-link">{{$notification->data['comic_title']}}</a>
</div>