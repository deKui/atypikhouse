<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Habitat extends Model
{
    protected $casts = [
        'let_avis' => 'array'
    ];

    /**
     * Auteur : Lucas 
     * Obtient le proprietaire d'un habitat
     */
	public function proprio()
    {
        return $this->belongsTo(User::class, 'id_proprietaire');
    }

    /**
     * Auteur : Lucas 
     * Obtient le type d'un habitat
     */
    public function type()
    {
        return $this->belongsTo(TypeHabitats::class, 'id_type_habitat');
    }
}
