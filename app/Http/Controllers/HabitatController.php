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

        $typeHabitat = TypeHabitats::all();

        return view('habitat.index', compact('habitats', 'typeHabitat'));
    }

    /**
     * Affiche les dernières habitats
     */
    public function showLastHabitats() {

    	$habitats = Habitat::all();

        $typeHabitat = TypeHabitats::all();

        return view('habitat.showLastHabitats', compact('habitats', 'typeHabitat'));
    }


    /**
     * Affiche les habitats par type
     * @param  string $slug 
     * @return               
     */
    public function typeHabitat(string $slug) {

        $typeActuel = TypeHabitats::where('slug', $slug)->first();

        $typeHabitat = TypeHabitats::all();

        $habitats = $this->repo->getHabitatBySlug($slug);

        return view('habitat.typeHabitat', compact('typeHabitat', 'habitats', 'typeActuel'));
    }


    /**
     * Auteur : Lucas
     * Affiche un seul habitat après un recherche
     */
    public function showAfterSearch(Habitat $habitat, $nb_personne, $date_debut, $date_fin, $duree) {

        $typeHabitat = TypeHabitats::all();
        
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

        return view('habitat.showAfterSearch', compact('habitats', 'messages', 'reservation', 'voyageurs', 'arrivee', 'depart', 'duree', 'typeHabitat'));
    }


    /**
     * Affiche un seul habitat
     */
    public function show(Habitat $habitat) {

        $typeHabitat = TypeHabitats::all();
        
        $habitats = $this->repo->getHabitat($habitat->id);
        
        $messages = Avis::where('id_habitat', $habitat->id)->get();

        $reservation = Reservation::where('id_locataire', Auth::id())->where('id_habitat', $habitat->id)->first();

        if ($reservation == []) {
            $reservation = "2100-01-01";   
        }else {
            $reservation = $reservation->date_fin;
        }

        return view('habitat.show', compact('habitats', 'messages', 'reservation' ,'typeHabitat'));
    }


    /**
     * Affiche la page pour enregistrer un nouvel habitat
     */
    public function create()
    {
        $typeHabitat = TypeHabitats::all();

        return view('habitat.create', compact('typeHabitat'));
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


    /* 
     * Auteur : Valériane
     * Récupére les habitats en fonction du propriétaire
    */
    public function showHabitatProprio(Reservation $reservation, $id_proprio){

        $typeHabitat = TypeHabitats::all();

        $habitatProprio = $this->repo->getHabitatProprio($id_proprio);

        $reservationProprio = $reservation->getReservationProprio($id_proprio);

        return view('habitat.proprio', compact('habitatProprio','reservationProprio', 'typeHabitat'));
    } 

    /**
     * Auteur : Valériane
     * Supprime un habitat
     */
    public function delete($id_habitat){

        $proprio = Auth::user()->id;

        $reservationForHbitat = Reservation::where('id_habitat', $id_habitat)->get();

        if ($reservationForHbitat->isNotEmpty()) {
            return redirect(route('profil.proprio', ['id_utilisateur' => $proprio]))->with('ok', __('Désolé, vous ne pouvez pas supprimer cet habitat car des réservations sont en cours sur celui-ci !'));;

        }

        $habitat = Habitat::find($id_habitat);
        $habitat->delete($id_habitat);

        //return redirect('proprio/' + $proprio); 

        return redirect(route('profil.proprio', ['id_utilisateur' => $proprio]));

    }

    /**
     * Auteur : Valériane
     * Affiche la page pour éditer un habitat
     */
    public function edit($id_habitat) 
    {
        $typeHabitat = TypeHabitats::all();

        $habitat = $this->repo->getHabitat($id_habitat);

        return view('habitat.edit', compact('habitat', 'typeHabitat'));    
    }


    /**
     * Auteur : Valériane
     * Mise à jour d'un un habitat
     */
    public function update(Request $request, $id_habitat) 
    {

        $proprio = Auth::user()->id;

        $habitat = $this->repo->getHabitat($id_habitat);

        $photo = Storage::disk('public')->put('', $request->file('photo'));
        
        // on remplace les anciens champs par les nouveaux dans la bdd
        $habitat->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'photo' => $photo,
            'adresse' => $request->adresse,
            'code_postal' => $request->code_postal,
            'ville' => $request->ville,
            'nb_lit_simple' => $request->nb_lit_simple,
            'nb_lit_double' => $request->nb_lit_double,
            'nb_personne_max' => $request->nb_personne_max,
        ]);
        
        // Enregistre les modifications de la bdd
        $habitat->save();

        return redirect(route('profil.proprio', ['id_utilisateur' => $proprio]));
    }


    /************************************* Gérant ******************************************/


    /**
     * Affiche la page pour ajouter un type d'habitat
     */
    public function addType() {
        $typeHabitat = TypeHabitats::all();

        return view('habitat.addType', compact('typeHabitat'));
    }


    /**
     * Enregistre un nouveau type d'habitat
     * @param  Request $request            
     */
    public function storeType(Request $request) {
        
        $request->validate([
            'typeHabitat' => 'required|string|max:255',
        ]);

        TypeHabitats::create([
            'nom' => $request->typeHabitat,
            'slug' => str_slug($request['typeHabitat'], '-')
        ]);

        return redirect()->route('profil.gerant')->with('ok', __('Le type a bien été ajouté'));
    }

}
