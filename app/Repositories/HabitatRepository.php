<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Habitat;
use App\Models\TypeHabitats;
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


    public function getHabitatBySlug(string $slug) {
    	$typeId = TypeHabitats::where('slug', $slug)->select('id')->first();

    	$habitat = $this->habitat->newQuery()->where('id_type_habitat', $typeId->id)->get();

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