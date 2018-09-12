<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\RechercheRequest;
use App\Models\Habitat;

class RechercheController extends Controller
{
    /**
     * Affiche le résultat de la recherche
     */
    public function index(RechercheRequest $request) 
    {
        $habitats = Habitat::where('ville', $request->destination)
                            ->where('nb_personne_max', '>=', $request->voyageurs)
                            ->where('date_debut_dispo', '<',  $request->depart)
                            ->where('date_fin_dispo', '>',  $request->retour)
                            ->distinct()
                            ->get();

    	$infoRecherche = [$request->destination, $request->voyageurs, $request->depart, $request->retour];

        //dd($infoRecherche);

    	return view('recherche.recherche', compact('habitats', 'infoRecherche'));	
    }
}
