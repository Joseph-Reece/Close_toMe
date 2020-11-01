<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class doctor extends Model
{
    /**
     * Get the department that owns the doctor.
     */
    public function department()
    {
        return $this->belongsTo('App\department');
    }

    /**
     * Get the prescritions made by each doctor.
     */

    public function prescriptions()
    {
        return $this->hasMany('App\prescription');
    }


   /*  public function user()
    {
        return $this->hasOne('App\User');
    } */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function chats()
    {
        return $this->hasManyThrough('App\Chat', 'App\User');
    }

}
