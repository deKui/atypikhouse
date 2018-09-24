<?php

namespace App\Http\Resources;
use DB;

use Illuminate\Http\Resources\Json\Resource;

class Avis extends Resource
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
            'id_utilisateur' => $this->id_utilisateur,
            'id_habitat' => $this->id_habitat,
            'note' => $this->note,
            'comment' => $this->comment,
            'signale' => $this->signale,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'auteur' => DB::table('users')->select('pseudo')->where('id', '=', $this->id_utilisateur)->get(),

        ];


    }
}
