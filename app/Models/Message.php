<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'id_utilisateur', 'id_proprietaire', 'content',
    ];
}
