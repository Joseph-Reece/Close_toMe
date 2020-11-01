<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class appointment extends Model
{
    //
    use Notifiable;

    /**
     * Get the department that owns the appointment.
     */
    public function department()
    {
        return $this->belongsTo('App\department');
    }

    /**
     * Get the patient that owns the appointment.
     */
    public function patient()
    {
        return $this->belongsTo('App\patient');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
