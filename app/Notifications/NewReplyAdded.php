<?php

namespace App\Notifications;

use App\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyAdded extends Notification
{
    use Queueable;

    /**
     * La discussion qui fait l'objet d'une réponse
     * @var Discussion
     */
    public $discussion;

    /**
     * Create a new notification instance.
     *
     * @param Discussion $discussion
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail' ,'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Une nouvelle réponse à été ajoutée à votre discussion')
                    ->action('Voir la discussion', route('discussions.show', $this->discussion->slug))
                    ->line('Lara - Forum pour vous servir !');
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
            'discussion' => $this->discussion
        ];
    }
}
