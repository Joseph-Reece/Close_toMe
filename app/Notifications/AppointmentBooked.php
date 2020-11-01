<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\appointment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentBooked extends Notification
{
    use Queueable;
    /**
     * The appointment instance.
     *
     * @var appointment
     */
    protected $appointment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(appointment $appointment)
    {
        //
        $this->appointment = $appointment;
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
        return (new MailMessage)
                    ->line('Appointment Booked successfully.')
                    ->line('Appointment Date:', $this->appointment->appointment_date)
                    ->line('Appointment time:', $this->appointment->appointment_time)
                    ->action('Notification Action', route('client.dashboard'))
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
            'patient_id' => $this->appointment->patient_id,
            'AppointmentDate' => $this->appointment->appointment_date,
            'AppointmentTime' => $this->appointment->appointment_time,
            'AppointmentReason' => $this->appointment->reason,
        ];
    }
}
