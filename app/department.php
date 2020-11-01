<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{

    /**
     * Get the appointments for each department.
     */
    public function appointment()
    {
        return $this->hasMany('App\appointment');
    }


    /**
     * Get the doctors in each department.
     */

    public function doctors()
    {
        return $this->hasMany('App\doctor');
    }

    public function users()
    {
        return $this->hasManyThrough('App\User', 'App\doctor');
    }

    public function chats()
    {
        return $this->hasMany('App\Chat');
    }
}
