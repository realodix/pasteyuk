<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
