@extends('layouts.app')

@section('content')
    <div class="following">
        <div class="user-list">
            <div class="user-list__title">
                <h2 class="title title_theme_header">{{$user->name}} following</h2>
            </div>
            <div class="user-list__users">
                <div class="user-list__col">
                    @forelse($user->following as $following)
                        <div class="user-list__user">
                            <div class="user user_size_l user_theme_dark">
                                <a href="#" class="avatar">
                                    <img src="{{$following->image}}" class="avatar__image" alt="{{$following->name}}" role="presentation" />
                                </a>
                                <a href="/profile/{{$following->id}}" class="user__username">{{$following->name}}</a>
                            </div>
                        </div>
                    @empty
                        <div class="user-list__none">
                            <p class="description description_theme_none">No following.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection