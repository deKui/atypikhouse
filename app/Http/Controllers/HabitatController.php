<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Repositories\HabitatRepository;
use App\Http\Requests\HabitatRequest;
use App\Models\Habitat;
use App\Models\TypeHabitats;
use App\Models\Avis;
use App\Models\Reservation;

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
     * Affiche tous les habitats
     */
    public function index() {

    	$habitats = Habitat::all();

        return view('habitat.index', compact('habitats'));
    }

    /**
     * Affiche les dernières habitats
     */
    public function showLastHabitats() {

        $habitats = Habitat::all();
        return view('habitat.showLastHabitats', compact('habitats','message'));
    }


    /**
     * Auteur : Lucas
     * Affiche un seul habitat après un recherche
     */
    public function showAfterSearch(Habitat $habitat, $nb_personne, $date_debut, $date_fin, $duree) {
        
    	$habitats = $this->repo->getHabitat($habitat->id);
        
        $messages = Avis::where('id_habitat', $habitat->id)->get();

        $reservation = Reservation::where('id_locataire', Auth::id())->where('id_habitat', $habitat->id)->first();

        if ($reservation == []) {
            $reservation = "2100-01-01";   
        }else {
            $reservation = $reservation->date_fin;
        }

        $voyageurs = $nb_personne;

        $arrivee = $date_debut;
        $depart = $date_fin;

        return view('habitat.showAfterSearch', compact('habitats', 'messages', 'reservation', 'voyageurs', 'arrivee', 'depart', 'duree'));
    }


    /**
     * Affiche un seul habitat
     */
    public function show(Habitat $habitat) {
        
        $habitats = $this->repo->getHabitat($habitat->id);
        
        $messages = Avis::where('id_habitat', $habitat->id)->get();

        $reservation = Reservation::where('id_locataire', Auth::id())->where('id_habitat', $habitat->id)->first();

        if ($reservation == []) {
            $reservation = "2100-01-01";   
        }else {
            $reservation = $reservation->date_fin;
        }

        return view('habitat.show', compact('habitats', 'messages', 'reservation'));
    }


    /**
     * Affiche la page pour enregistrer un nouvel habitat
     */
    public function create()
    {

        $type_habitat = TypeHabitats::all();

        return view('habitat.create', compact('type_habitat'));
    }


    /**
     * Enregistre un nouvel Habitat dans la bdd
     */
    public function store(HabitatRequest $request)
    {
        $proprio = Auth::user()->id;

        $image = Storage::disk('public')->put('', $request->file('image'));

        Habitat::create([
            'id_proprietaire' => $proprio,
            'id_type_habitat' => $request->type_habitat,
            'titre' => $request->titre,
            'description' => $request->description,
            'photo' => $image,
            'adresse' => $request->adresse,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'nb_lit_simple' => $request->nb_lit_simple,
            'nb_lit_double' => $request->nb_lit_double,
            'nb_personne_max' => $request->nb_personne_max,
            'date_debut_dispo' => date('Y-m-d', strtotime($request->date_debut_dispo)),
            'date_fin_dispo' => date('Y-m-d', strtotime($request->date_fin_dispo)),
            'prix' => $request->prix,
        ]);

        return redirect(route('home'));
    }


	/* ATT - Mettre le nom de de la variable pareil que dans (compact) */
	
    public function showAllProprietaire($id_proprietaire){

         $habitatProprio = $this->repo->getHabitatProprio($id_proprietaire);

        return view('habitat.showAllProprietaire', compact('habitatProprio'));
    }

}
