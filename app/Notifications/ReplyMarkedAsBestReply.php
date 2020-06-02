<?php

namespace App\Notifications;

use App\Discussion;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyMarkedAsBestReply extends Notification
{
    use Queueable;
    /**
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
        return ['mail', 'database'];
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
                    ->greeting('Bonjour '.$this->discussion->bestReply->owner->name)
                    ->subject('Votre réponse à la discussion')
                    ->line('Votre réponse a été choisie comme meilleure réponse !')
                    ->action('Voir la discussion', route('discussions.show', $this->discussion->slug))
                    ->line('Merci de nous faire confiance ! ')
            ;
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
