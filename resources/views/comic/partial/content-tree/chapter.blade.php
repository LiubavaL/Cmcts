<li class="chapters__chapter
@if(!Date::moreThanDays($chapter->created_at, 7))
chapters__chapter_new
@endif
">
    <a href="/comic/{{$comicSlug}}/{{$volumeSequence}}/{{$chapter->sequence}}/1" class="chapter">
        <span class="chapter__title">Chapter {{$loopIndex + 1}}
            @if(!empty($chapter->title))
                . {{$chapter->title}}
            @endif
        </span>
        <span class="chapter__date">{{Date::fdyFormat($chapter->created_at)}}</span>
    </a>
</li>