<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reservation extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_locataire', 'id_habitat', 'date_debut', 'date_fin', 'montant',
    ];


	 /**
     * Return les locations passées en fonction d'un utisateur
     */
    public function getReservationPassee($id_locataire) {

    	//$reservation = Reservation::where('id_locataire', $id_locataire)->get();

        $reservPassee = Reservation::
                        join('users', 'reservations.id_locataire', '=', 'users.id')
                        ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
                        ->select('users.*','habitats.*','reservations.*')
                        ->where('reservations.date_fin','>', date_create('now')->format('Y-m-d'))
                        ->where('reservations.id_locataire','=',$id_locataire)
                        ->get();
        return $reservPassee;
    }

     /**
     * Return les locations passées en fonction d'un utisateur
     */
    public function getReservationFuture($id_locataire) {

        //$reservation = Reservation::where('id_locataire', $id_locataire)->get();

        $reservFuture = DB::table('reservations')
                        ->join('users', 'reservations.id_locataire', '=', 'users.id')
                        ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
                        ->select('users.*','habitats.*','reservations.*')
                        ->where('reservations.date_debut','<', date_create('now')->format('Y-m-d'))
                        ->where('reservations.id_locataire','=',$id_locataire)
                        ->get();

        return $reservFuture;
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

}