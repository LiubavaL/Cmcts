@if($like->type_id == 1)
    @include('comic.partial.responces.happy', ['like' => $like, 'hasLike' => $hasLike])
@elseif($like->type_id == 2)
    @include('comic.partial.responces.wondering', ['like' => $like, 'hasLike' => $hasLike])
@elseif($like->type_id == 3)
    @include('comic.partial.responces.sad', ['like' => $like, 'hasLike' => $hasLike])
@endif