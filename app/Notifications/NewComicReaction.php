<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class NewComicReaction extends Notification
{
    use Queueable;


    protected $rater;
    protected $comic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $comic)
    {
        $this->rater = $user;
        $this->comic = $comic;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->view(
            'vendor.notifications.email-new-comic-subscription', [
                'rater' => $this->rater,
                'comic' => $this->comic,
                'receiver' => Auth::user()
            ]
        );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'rater_id' => $this->subscriptor->id,
            'rater_name' => $this->subscriptor->name,
            'comic_slug' => $this->comic->slug,
            'comic_title' => $this->comic->title,
        ];
    }
}
