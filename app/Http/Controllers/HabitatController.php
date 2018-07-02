<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitat;

class HabitatController extends Controller
{
    protected $habitat;

    /**
     * Create a new HabitatController instance.
     */
    public function __construct(Habitat $habitat)
    {
        $this->habitat = $habitat;
    }

    /**
     * Affiche toutes les habitats
     */
    public function index() {

    	$habitats = Habitat::all();

        return view('habitat.index', compact('habitats'));
    }


    /**
     * Affiche un habitat à partir de son id
     */
    public function show($id_habitat) {

    	$habitat = $this->habitat->getHabitat($id_habitat);

        return view('habitat.show', compact('habitat'));
    }
}
