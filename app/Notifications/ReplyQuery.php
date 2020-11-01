<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Chat;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyQuery extends Notification
{
    use Queueable;

    /**
     * The appointment instance.
     *
     * @var appointment
     */
    protected $chat;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(chat $chat)
    {
        //
        $this->chat = $chat;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have a reply to your previous query.')
                    ->line('Query', $this->chat->query)
                    ->line('Login to view reply')
                    ->action('View Reply', route('client.dashboard'))
                    ->line('Thank you for using our application!');
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
            //

            'DoctorName' => $this->chat->doctor,
            'Chat_id' => $this->chat->id,
        ];
    }
}
