<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Habitat extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_proprietaire', 'id_type_habitat', 'titre', 'description', 'photo', 'adresse', 'code_postal', 'ville', 'nb_lit_simple', 'nb_lit_double', 'nb_personne_max', 'date_debut_dispo', 'date_fin_dispo', 'prix',
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

    /** 
    * Auteur : Valériane
    *  Retourne les habitats d'un propriétaire
    */
    public function getHabitatProprio($id_proprietaire)
    {
        $habitatProprio = Habitat::where('id_proprietaire', $id_proprietaire)->get();

        return $habitatProprio;
    }


    /** 
    * Auteur : Valériane
    *  Retourne les habitats d'un propriétaire
    */
    public function getHabitat($id_habitat)
    {
        $habitat = Habitat::all();

        return $habitat;
    }


}
