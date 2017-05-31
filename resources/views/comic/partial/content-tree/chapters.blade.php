<ul class="chapters">
    <li>
        <ul class="chapters__chapters">
            @foreach ( $comic->volumes->first()->chapters as $chapter )
                @include('comic.partial.content-tree.chapter', ['comicSlug' => $comic->slug, 'volumeSequence' => 0, 'loopIndex' => $loop->index, 'chapter' => $chapter ])
            @endforeach
        </ul>
    </li>
</ul>