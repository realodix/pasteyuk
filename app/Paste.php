<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paste extends Model
{
    protected $fillable = [
        'userId',
        'title',
        'content',
        'link',
        'views',
        'ip',
        'syntax',
        'expiration',
        'privacy',
        'password',
        'burnAfter',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'userId', 'id');
    }

    public function pasteSyntax()
    {
        return $this->hasOne('App\PastesSyntax', 'syntax_id', 'syntax');
    }
}
