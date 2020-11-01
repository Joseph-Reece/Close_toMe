<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    //
    /**
     * Get the patient that owns the prescription.
     */
    public function patient()
    {
        return $this->belongsTo('App\patient');
    }
    /**
     * Get the doctor that owns the prescription.
     */
    public function doctor()
    {
        return $this->belongsTo('App\doctor');
    }

    /**
     * Get the doctor that owns the prescription.
     */
   public function user()
   {
       return $this->belongsTo('App\User');
   }

}
