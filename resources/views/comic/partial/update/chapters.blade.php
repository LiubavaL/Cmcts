@if($comic->volumes->first()->sequence !== 0)
    @include('comic.partial.update.content.volumes', ['comic'=>$comic])
@else
    @include('comic.partial.update.content.chapters', ['comic'=>$comic])
@endif