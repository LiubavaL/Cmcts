<div class="notification__icon">
    <svg class="notification__i-fav"><use xlink:href="/images/icon.svg#icon_comments"></use></svg>
</div>
<div class="notification__content">
    <a href="/profile/{{$notification->data['responcer_id']}}" class="button button_theme_bubble-gum-link">{{$notification->data['responcer_name']}}</a>
    <span class="notification__text">leaved a responce on your comic</span>
    <a href="/comic/{{$notification->data['comic_slug']}}" class="button button_theme_bubble-gum-link">{{$notification->data['comic_title']}}</a>
</div>