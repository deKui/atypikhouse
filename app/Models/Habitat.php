<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Habitat extends Model
{

	/**
     * Return le nom d'un utilisateur à partir de son id
     */
    public function getNameUser($id_user) {

    	$user = DB::table('users')->where('id', $id_user)->first();

        return $user->name;
    }


    /**
     * Return le nom d'un type à partir de son id
     */
    public function getNameType($id_type) {

    	$type = DB::table('type_habitats')->where('id', $id_type)->first();

        return $type->nom;
    }

    /**
     * Return un habitat à partir de son id
     */
    public function getHabitat($id_habitat) {

    	$habitat = Habitat::where('id', $id_habitat)->first();

        return $habitat;
    }

    /*** Retourne les habitats d'un propriétaire ***/

    public function getHabitatProprio($id_proprietaire) {

        $habitat = Habitat::where('id_proprietaire', $id_proprietaire)->get();

        return $habitat;
    }
}
