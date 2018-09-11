<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from_id', 'to_id', 'note',
    ];
}
