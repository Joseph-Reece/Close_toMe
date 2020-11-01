<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    //
    /**
     * Get the kin for each patient.
     */

    public function kins()
    {
        return $this->hasMany('App\kin');
    }

    /**
     * Get the appointments for each patient.
     */

    public function appointment()
    {
        return $this->hasMany('App\appointment');
    }

    /**
     * Get the prescriptions for each patient.
     */

    public function prescriptions()
    {
        return $this->hasMany('App\prescription');
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

}
