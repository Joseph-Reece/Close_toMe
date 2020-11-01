<?php

namespace App;

use App\Notifications\ClientResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Client as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Laratrust\Traits\LaratrustUserTrait;


class Client extends Authenticatable  implements MustVerifyEmail
{
    use Notifiable;
    use LaratrustUserTrait;


    protected $guard = 'client';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPasswordNotification($token));
    }

    public function patient()
    {
        return $this->hasOne('App\patient');
    }

    public function kin()
    {
        return $this->hasManyThrough('App\kin', 'App\patient');
    }


    public function chat()
    {
        return $this->hasMany('App\Chat');
    }

    public function prescriptions()
    {
        return $this->hasManyThrough('App\prescription', 'App\patient');
    }

    public function appointments()
    {
        return $this->hasManyThrough('App\appointment', 'App\patient');
    }


}
