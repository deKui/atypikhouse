<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\Habitat;
use App\Http\Resources\Habitat as HabitatResource;
use DB;

class User extends Resource
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
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'pseudo' => $this->pseudo,
            'email' => $this->email,
            'password' => $this->password,
            'avatar' => $this->avatar,
            'date_naissance' => $this->date_naissance,
            'description' => $this->description,
            'note_eval' => $this->note_eval,
            'role' => $this->role,
            'active' => $this->active,
            'signale' => $this->signale,
            'remember_token' => $this->remember_token,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'habitats' => $users = DB::table('habitats')->where('id_proprietaire', '=', $this->id)->get(),
        ];    }
}
