<ul class="chapters">
    @foreach ( $comic->volumes as $volume )
        <li class="chapters__volume">
            <div class="chapters__v-title">Volume {{$loop->index + 1}}
                @if(!empty($volume->title))
                    . {{$volume->title}}
                @endif
            </div>
            <ul class="chapters__chapters">
                @foreach ( $volume->chapters as $chapter )
                    @include('comic.partial.content-tree.chapter', ['comicSlug' => $comic->slug, 'volumeSequence' => $volume->sequence, 'loopIndex' => $loop->index, 'chapter' => $chapter ])
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>