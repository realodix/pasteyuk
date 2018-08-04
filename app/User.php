<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Attribute yang dapat ditetapkan secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
    ];

    /**
     * Attributes yang harus disembunyikan untuk array.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pastes()
    {
        return $this->hasMany('App\Paste', 'userId');
    }
}
