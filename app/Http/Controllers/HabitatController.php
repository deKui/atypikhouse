<?php

namespace App\Http\Controllers;

use App\Repositories\HabitatRepository;
use Illuminate\Http\Request;
use App\Models\Habitat;
use App\Models\Avis;

class HabitatController extends Controller
{
    /**
     * @var HabitatRepository
     */
    protected $repo;

    /**
     * Create a new HabitatController instance.
     */
    public function __construct(HabitatRepository $habitatRepository)
    {
        $this->repo = $habitatRepository;
    }

    /**
     * Affiche toutes les habitats
     */
    public function index() {

    	$habitats = Habitat::all();

        return view('habitat.index', compact('habitats'));
    }


    /**
     * Affiche un habitat
     */
    public function show(Habitat $habitat) {
        
    	$habitats = $this->repo->getHabitat($habitat->id);
        
        $messages = Avis::where('id_habitat', $habitat->id)->get();

        return view('habitat.show', compact('habitats', 'messages'));
    }
}
