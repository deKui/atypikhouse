<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use App\Http\Requests\RechercheRequest;
use App\Models\Habitat;

class RechercheController extends Controller
{
    /**
     * Auteur : Lucas
     * Affiche le résultat de la recherche
     */
    public function index(RechercheRequest $request) 
    {
        // recherche 
        $habitats = Habitat::where('ville', $request->destination)
                            ->where('nb_personne_max', '>=', $request->voyageurs)
                            ->where('date_debut_dispo', '<',  $request->depart)
                            ->where('date_fin_dispo', '>',  $request->retour)
                            ->distinct()
                            ->get();

        if ($habitats->isEmpty()) {
            return redirect('/')->with(['ok' => __("Désolé, aucun logement ne correspond à vos critères, veuillez modifier votre recherche !")]);
        }

    	$nb_personne = $request->voyageurs;

        // conversion en type DateTime pour calculer le nombre de nuits
        $date_debut = new DateTime($request->depart);
        $date_fin = new DateTime($request->retour);

        // nombre de nuit(s) 
        $duree = $date_fin->diff($date_debut);

        // affichage du nombre de nuit(s)
        $duree = $duree->format('%d');

        // affichage des dates au format necessaire
        $date_debut = $date_debut->format('Y-m-j');
        $date_fin = $date_fin->format('Y-m-j');

    	return view('recherche.recherche', compact('habitats', 'nb_personne', 'date_debut', 'date_fin', 'duree'));	
    }
}
