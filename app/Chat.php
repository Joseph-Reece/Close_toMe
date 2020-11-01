<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function department()
    {
        return $this->belongsTo('App\department');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
