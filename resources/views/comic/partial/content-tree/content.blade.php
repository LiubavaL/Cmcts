@if($comic->volumes->first()->sequence !== 0)
    @include('comic.partial.content-tree.volumes', ['comic' => $comic])
@else
    @include('comic.partial.content-tree.chapters', ['comic' => $comic])
@endif