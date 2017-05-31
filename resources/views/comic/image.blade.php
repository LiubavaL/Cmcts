@extends('layouts.app')
@section('content')
    <div class="comic-page">
        @include('comic.partial.page-controls.control-panel', ['comic' => $comic,'chapterImages' => $chapterImages,'prevPage' => $prevPage, 'nextPage' => $nextPage, 'volumeSequence' => $volumeSequence, 'chapterSequence' => $chapterSequence, 'imageSequence' => $imageSequence])
        @if ($curPage)
            <img src="{{get_s3_bucket().get_s3_page_path($curPage->name)}}" class="comic-page__page" role="presentation" />
        @endif
        @include('comic.partial.page-controls.control-panel', ['comic' => $comic,'chapterImages' => $chapterImages,'prevPage' => $prevPage, 'nextPage' => $nextPage, 'volumeSequence' => $volumeSequence, 'chapterSequence' => $chapterSequence, 'imageSequence' => $imageSequence])
        <div class="comic-page__comments">
            <div class="comments comments_theme_page-comments">
                @forelse($curPage->image_comments as $comment)
                    @include('comic.partial.page-controls.image_comment', ['comment'=>$comment])
                @empty
                    <h3>No comments yet.</h3>
                @endforelse
                @if(!empty($authUser))
                    <div class="comments__comment" id="comment">
                        <div class="comment">
                            <div class="comment__avatar">
                                <a href="/profile/{{$authUser->id}}" class="avatar avatar_size_s">
                                    <img src="{{get_s3_bucket().get_avatar_path('s').$authUser->image}}" class="avatar__image" alt="{{$authUser->name}}" role="presentation" />
                                </a>
                            </div>
                            <span class="comment__add">
                                <input type="hidden" name="iid" value="{{$curPage->id}}">
                                <textarea name="comment" placeholder="What do you think about it? " class="comment__textarea"></textarea>
                                <span class="comment__add-button">
                                    <a href="#" id="add-comment" class="button button_theme_bubble-gum-light button_size_s">
                                        <span class="loader loader_size_s" style="display:none">
                                            <span class="loader__circle-group">
                                                <span id="circle_1" class="loader__circle loader__circle_1"></span>
                                                <span id="circle_2" class="loader__circle loader__circle_2"></span>
                                                <span id="circle_3" class="loader__circle loader__circle_3"></span>
                                            </span>
                                        </span>
                                    Post</a>
                                </span>
                            </span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection