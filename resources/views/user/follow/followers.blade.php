@extends('layouts.app')

@section('content')
    <div class="followers">
        <div class="user-list">
            <div class="user-list__title">
                <h2 class="title title_theme_header">{{$user->name}}'s followers</h2>
            </div>
            <div class="user-list__users">
                <div class="user-list__col">
                    @forelse($user->followers as $follower)
                        <div class="user-list__user">
                        <div class="user user_size_l user_theme_dark">
                            <a href="#" class="avatar">
                                <img src="{{$follower->image}}" class="avatar__image" alt="{{$follower->name}}" role="presentation" />
                            </a>
                            <a href="/profile/{{$follower->id}}" class="user__username">{{$follower->name}}</a>
                        </div>
                    </div>
                    @empty
                        <div class="user-list__none">
                            <p class="description description_theme_none">No followers.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection