<div class="preview-card__col">
    <svg class="preview-card__i-views"><use xlink:href="/images/icon.svg#icon_views"></use></svg>
    <div class="preview-card__count">{{Count::formatCut($comic->views)}}</div>
</div>
<div class="preview-card__col">
    <svg class="preview-card__i-coms"><use xlink:href="/images/icon.svg#icon_comments"></use></svg>
    <div class="preview-card__count">{{Count::formatCut($comic->comments_count)}}</div>
</div>
@if(Auth::id() == $user->id)
    <div class="preview-card__col">
        <svg class="preview-card__i-favs"><use xlink:href="/images/icon.svg#icon_favorites"></use></svg>
        <span class="preview-card__count">{{Count::formatCut($comic->subscribers_count)}}</span>
    </div>
@else
    <a href="#" class="preview-card__col">
        <svg class="preview-card__i-favs"><use xlink:href="/images/icon.svg#icon_favorites"></use></svg>
        <span class="preview-card__count">{{Count::formatCut($comic->subscribers_count)}}</span>
    </a>
@endif