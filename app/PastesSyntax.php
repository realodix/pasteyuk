<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PastesSyntax extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'syntax_id',
        'syntax_name'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pastes_syntax';
}
