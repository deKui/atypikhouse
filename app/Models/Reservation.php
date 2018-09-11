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
     * Return les locations en fonction d'un utisateur
     */
    public function getReservation($id_locataire) {

    	$reservation = Reservation::where('id_locataire', $id_locataire)->get();

        return $reservation;
    }


}