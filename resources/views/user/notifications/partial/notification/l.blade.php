<div class="notification notification_size_l @if($notification->unread())notification_new @endif">
    @if($notification->type == 'App\Notifications\NewFollower')
        @include('user.notifications.partial.notification.types.new-follower', ['notification' => $notification])

    @elseif($notification->type == 'App\Notifications\NewComicSubscription')
        @include('user.notifications.partial.notification.types.new-subscription', ['notification' => $notification])

    @elseif($notification->type == 'App\Notifications\NewComicResponce')
        @include('user.notifications.partial.notification.types.new-responce', ['notification' => $notification])

    @elseif($notification->type == 'App\Notifications\NewComicReaction')
        @include('user.notifications.partial.notification.types.new-reaction', ['notification' => $notification])
    @endif
</div>