<?php

namespace App\Http\Resources;

use DB;
use App\Models\Avis;
use App\Http\Resources\Avis as AvisResource;
use App\Models\Reservation;
use App\Http\Resources\Reservation as ReservationResource;
use Illuminate\Http\Resources\Json\Resource;

class Habitat extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,
        'id_proprietaire' => $this->id_proprietaire,
        'id_type_habitat' => $this->id_type_habitat,
        'titre' => $this->titre,
        'description' => $this->description,
        'photo' => $this->photo,
        'adresse' => $this->adresse,
        'code_postal' => $this->code_postal,
        'ville' => $this->ville,
        'nb_lit_simple' => $this->nb_lit_simple,
        'nb_lit_double' => $this->nb_lit_double,
        'nb_personne_max' => $this->nb_personne_max,
        'date_debut_dispo' => $this->date_debut_dispo,
        'date_fin_dispo' => $this->date_fin_dispo,
        'prix' => $this->prix,
        'signale' => $this->signale,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        'avis' => AvisResource::collection(Avis::all()->where('id_habitat', '=', $this->id)),
        'proprietaire' => DB::table('users')->select('pseudo')->where('id', '=', $this->id_proprietaire)->get(),
        'reservations' => ReservationResource::collection(Reservation::all()->where('id_habitat', '=', $this->id)),
        ]; 
    }
}
