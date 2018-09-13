<?php

<<<<<<< HEAD
namespace App;

=======
namespace App\Models;

use Illuminate\Notifications\Notifiable;
>>>>>>> c20d4861943c6040d1b798025f7d2398537e4c55
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
<<<<<<< HEAD
=======
    
>>>>>>> c20d4861943c6040d1b798025f7d2398537e4c55
}
