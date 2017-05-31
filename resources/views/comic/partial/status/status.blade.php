@if($status->id == 1)
    @include('comic.partial.status.ongoing', ['status' => $status])
@elseif($status->id == 2)
    @include('comic.partial.status.frozen', ['status' => $status])
@elseif($status->id == 3)
    @include('comic.partial.status.finished', ['status' => $status])
@endif