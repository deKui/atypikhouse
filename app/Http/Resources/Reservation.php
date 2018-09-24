<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use DB;


class Reservation extends Resource
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
            "id" => $this->id,
            "id_locataire" => $this->id_locataire,
            "id_habitat" => $this->id_habitat,
            "date_debut" => $this->date_debut,
            "date_fin" => $this->date_fin,
            "montant" => $this->montant,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            'locataire' => DB::table('users')->select('pseudo')->where('id', '=', $this->id_locataire)->get(),

        ];
    }
}
