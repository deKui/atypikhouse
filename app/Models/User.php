<?php

namespace App\Models;

use App\Models\Avis;
use App\Models\Habitat;
use App\Models\Note;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo', 'prenom', 'nom', 'email', 'password', 'avatar', 'date_naissance', 'note_eval', 'active', 'signale',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Auteur : Lucas
     * Retourne un user à partir de son id
    */
    public function getUser($id_user)
    {
        $user = User::where('id', $id_user)->first();

        return $user;
    }


    /**
     * Auteur : Lucas
     * Retourne un user à partir de son nom
    */
    public function getUserByName($name_user)
    {
        $user = User::where('name', $name_user)->first();

        return $user;
    }


    /**
     * Auteur : Valériane
     * Retourne les avis signalés
    */
    public function getAvisSignale()
    {
        //$avisSignale = Avis::where('signale', true)->get();


      $avisSignale =  DB::table('avis')
                        ->join('users', 'avis.id_utilisateur', '=', 'users.id')
                        ->join('habitats', 'avis.id_habitat', '=', 'habitats.id')
                        ->select('users.id','habitats.id','users.pseudo', 'habitats.titre', 'avis.*')
                        ->where('avis.signale', true)
                        ->get();

        return $avisSignale;
    }


        /**
     * Auteur : Valériane
     * Retourne les habitats signalés
    */
    public function getHabitatSignale()
    {
        $habitatSignale = Habitat::where('signale', true)->get();

        return $habitatSignale;
    }


    /**
     * Auteur : Valériane
     * Retourne les utlisateurs signalés
    */
    public function getUserSignale()
    {
        $userSignale = User::where('signale', true)->get();

        return $userSignale;
    }


    /**
     * Auteur : Lucas
     * récupère toutes les notes
     */
    public function getNote($to_id) {
        $notes = Note::where('to_id', $to_id)->get();

        return $notes;
    }

}
