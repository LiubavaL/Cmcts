<div class="profile__grid">
    @forelse ( $comics as $comic )
        <div class="profile__preview-card">
            @include('comic.partial.preview.xm', ['comic' => $comic, 'user' => $user])
        </div>
    @empty
        @if(!$isSelfProfile || (!$comics->isNotEmpty() && !$addable))
            <div class="profile__empty-text">No comics has been added yet.</div>
        @endif
    @endforelse
    @if($isSelfProfile && !empty($comics) && $addable)
        <div class="profile__preview-card">
            <div class="profile__add-comic">
                <a href="/comic/create-1" class="button button_theme_add-comic">
                    <svg class="button__i-create"><use xlink:href="/images/icon.svg#icon_plus"></use></svg>
                </a>
            </div>
        </div>
    @endif
</div>