<div id="wonder" class="reactions__reaction
                            @if($hasLike == 2)
                            reactions__reaction_active
                            @endif
        ">
    <svg class="reactions__i-smile"><use xlink:href="/images/icon.svg#icon_wonder"></use></svg>
    <div class="reactions__reaction-count">
        {{($likeCount) ? $likeCount : 0}}
    </div>
</div>