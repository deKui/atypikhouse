<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $fillable = [
        'id_utilisateur', 'id_habitat', 'note', 'comment',
    ];


    public function from()
    {
    	return $this->belongsTo(User::class, 'id_utilisateur');
    }

    /**
     * Auteur : Valériane
     * Retourne les avis signalés
    */
    public function getAvisSignale()
    {
        $avisSignale = Avis::where('signale', true)->get();

        return $avisSignale;
    }



}
