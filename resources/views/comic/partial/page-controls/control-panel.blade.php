<div class="comic-page__controls">
    <div class="select select_theme_light select_size_l">
        <select style="width: 100%" class="select__select-hidden">
            @if($comic->volumes)
                @foreach ($comic->volumes as $volume)
                    @php
                    $parentLoop = $loop;
                    @endphp
                    @foreach ($volume->chapters as $chapter)
                        <option value="/comic/{{$comic->slug}}/{{$volume->sequence}}/{{$chapter->sequence}}" class="select__option-hidden">Volume {{$parentLoop->index}}. Chapter {{$loop->index}}. {{$chapter->title}}</option>
                    @endforeach
                @endforeach
            @else
                @foreach ($volume->chapters as $chapter)
                    <option value="/comic/{{$comic->slug}}/1/{{$chapter->sequence}}" class="select__option-hidden">Chapter {{$loop->index}}. {{$chapter->title}}</option>
                @endforeach
            @endif
        </select>
    </div>
    <a href="/comic/{{$comic->slug}}" class="title title_theme_name">Butsuri-san de Musou shitetara Motemote ni Narimashita</a>
    <div class="comic-page__page-nav">
        <a href="/comic/{{$comic->slug}}@if($prevPage){{'/'.$prevPage['volume'].'/'.$prevPage['chapter'].'/'.$prevPage['image']}}@endif" class="comic-page__arrow">
            <svg class="comic-page__i-arrow comic-page__i-arrow_l"><use xlink:href="/images/icon.svg#icon_arrow"></use></svg>
        </a>
        <div class="select select_theme_light select_size_s select_center">
            <select style="width: 100%" class="select__select-hidden">
                @foreach ($chapterImages as $image)
                    <option  class="select__option-hidden" @if ($imageSequence == $image->sequence) selected @endif
                    value="/{{$comic->slug.'/'.$volumeSequence.'/'.$chapterSequence.'/'.$image->sequence}}">
                        {{$image->sequence}}
                    </option>
                @endforeach
            </select>
        </div>
        <a href="/comic/{{$comic->slug}}@if($nextPage){{'/'.$nextPage['volume'].'/'.$nextPage['chapter'].'/'.$nextPage['image']}}@endif" class="comic-page__arrow">
            <svg class="comic-page__i-arrow comic-page__i-arrow_r"><use xlink:href="/images/icon.svg#icon_arrow"></use></svg>
        </a>
    </div>
</div>