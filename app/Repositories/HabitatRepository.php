<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Habitat;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class HabitatRepository {

	/**
	 * @var Habitat
	 */
	private $habitat;

	public function __construct(Habitat $habitat)
	{
		$this->habitat = $habitat;
	}


	/**
     * Auteur : Lucas
     * Return un habitat à partir de son id
     */
    public function getHabitat($id_habitat) {

    	$habitat = $this->habitat->newQuery()->where('id', $id_habitat)->first();

        return $habitat;
    }
    
	
	/** Auteur : Val
	** Retourne les habitats d'un proprio
	*/ 
	public function getHabitatProprio($id_proprietaire) {

        $habitat = Habitat::where('id_proprietaire', $id_proprietaire)->get();

        return $habitat;
    }











}