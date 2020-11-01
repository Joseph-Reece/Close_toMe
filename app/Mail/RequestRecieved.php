<?php

namespace App\Mail;

use App\appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestRecieved extends Mailable
{
    use Queueable, SerializesModels;

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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.notifications.email')
            ->with([
                'patient_id' => $this->appointment->patient_id,
                'AppointmentDate' => $this->appointment->appointment_date,
                'AppointmentTime' => $this->appointment->appointment_time,
                'AppointmentReason' => $this->appointment->reason,
            ]);;
    }
}
