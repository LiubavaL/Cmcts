<div id="happy" class="reactions__reaction
                            @if($hasLike == 1)
                            reactions__reaction_active
                            @endif
        ">
    <svg class="reactions__i-smile"><use xlink:href="/images/icon.svg#icon_happy"></use></svg>
    <div class="reactions__reaction-count">
        {{($likeCount) ? $likeCount : 0}}
    </div>
</div>