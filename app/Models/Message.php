<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'from_id', 'to_id', 'content', 'created_at', 'read_at',
    ];

    public $timestamps = false;

    protected $dates = ['created_at', 'read_at'];


    
    public function from() {
    	return $this->belongsTo(User::class, 'from_id');
    }
}
