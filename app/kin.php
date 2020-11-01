<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kin extends Model
{
    //

    protected $table='kins';

    public function patient()
    {
        return $this->belongsTo('App\patient');
    }


}
