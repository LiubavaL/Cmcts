@extends('layouts.app')

@section('content')
    <div class="notifications">
        <div class="notifications__content">
            <div class="notifications__title">
                <h2 class="title title_theme_header">Notifications</h2>
            </div>
            <div class="notifications__list">
                @forelse($user->notifications as $notification)
                    @include('user.notifications.partial.notification.l', ['notification' => $notification])
                    {{$notification->markAsRead()}}
                @empty
                    <p>No notifications.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
