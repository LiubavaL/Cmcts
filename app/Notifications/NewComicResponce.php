<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;

class NewComicResponce extends Notification
{
    use Queueable;

    protected $responcer;
    protected $comic;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $comic)
    {
        $this->responcer = $user;
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
        return ['mail', 'database'];
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
            'vendor.notifications.email-new-comic-responce', [
                'responcer' => $this->responcer,
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
            'subscriptor_id' => $this->subscriptor->id,
            'subscriptor_name' => $this->subscriptor->name,
            'comic_id' => $this->comic->id,
            'comic_title' => $this->comic->title
        ];
    }
}
