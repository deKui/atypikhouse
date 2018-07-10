<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitat;

class RechercheController extends Controller
{
    /**
     * Affiche le résultat de la recherche
     */
    public function index(Request $request) 
    {
    	$request->validate([
            'destination' => 'required|string|max:255',
            'voyageurs' => 'required|integer|max:50',
            'depart' => 'required|date_format:Y-m-d',
            'retour' => 'required|date_format:Y-m-d',
        ]);

        $habitats = Habitat::where('ville', $request->destination)
                            ->where('nb_personne_max', '>=', $request->voyageurs)
                            ->where('date_debut_dispo', '<',  $request->depart)
                            ->where('date_fin_dispo', '>',  $request->retour)
                            ->distinct()
                            ->get();

    	dd($habitats);

    	return view('recherche.recherche', compact('habitats'));	
    }
}
