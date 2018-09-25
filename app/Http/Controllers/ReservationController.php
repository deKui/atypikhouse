<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use App\Models\Habitat;
use App\Models\Reservation;
use App\Models\TypeHabitats;
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    protected $reservation;

    /**
     * Create a new HabitatController instance.
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_locataire)
    {
        $typeHabitat = TypeHabitats::all();

        $reservPassee = $this->reservation->getReservationPassee($id_locataire);

        $reservEnCours = $this->reservation->getReservationEnCours($id_locataire);
        
        $reservFuture = $this->reservation->getReservationFuture($id_locataire);

        return view('reservation.index', compact('reservPassee', 'reservFuture', 'reservEnCours', 'typeHabitat'));
    }

    /**
     * Affiche les réservation à partir d'un utilisateur
     */
    public function show() {
        //
    }


    /**
     * Affiche les détails de la réservation pour payer
     * @param  Habitat $habitat 
     * @param  ReservationRequest $request 
     * @return            
     */
    public function create(Habitat $habitat, ReservationRequest $request) {

        $typeHabitat = TypeHabitats::all();

        $id_locataire = Auth()->user()->id;
        $id_habitat = $habitat->id;

        // récupère toutes les réservations concernant cet habitat
        $reservations = Reservation::where('id_habitat', $id_habitat)->get();

        // conversion des dates en int pour les comparer
        $date_debut = new DateTime($request->date_debut);
        $date_debut = $date_debut->format('Ymd');

        $date_fin = new DateTime($request->date_fin);
        $date_fin = $date_fin->format('Ymd');

        // teste par rapport à chaque réservation existante si les dates dont disponibles  
        foreach ($reservations as $reservation) {
            // conversion des dates des réservations
            $date_resa_debut = new DateTime($reservation->date_debut);
            $date_resa_debut = $date_resa_debut->format('Ymd');

            $date_resa_fin = new DateTime($reservation->date_fin);
            $date_resa_fin = $date_resa_fin->format('Ymd');

            // la date de début ne doit pas être dans un intervalle de date d'une des réservations 
            if ($date_debut >= $date_resa_debut && $date_debut < $date_resa_fin) {

                return redirect('habitats/' . $habitat->id)->with(['ok' => __("Désolé, ces dates ne sont pas disponibles !")]);  
            
            // la date de fin ne doit pas être dans un intervalle de date d'une des réservations    
            }elseif ($date_fin > $date_resa_debut && $date_fin <= $date_resa_fin) {

                return redirect('habitats/' . $habitat->id)->with(['ok' => __("Désolé, ces dates ne sont pas disponibles !")]);
            }
        }
        
        $nbpersonne = $request->nb_personne;

        // conversion des dates pour le calcul de la durée
        $date_debut = new DateTime($request->date_debut);
        $date_fin = new DateTime($request->date_fin);

        // nombre de nuit(s) 
        $duree = $date_fin->diff($date_debut);

        // affichage du nombre de nuit(s)
        $duree = $duree->format('%d');

        // affichage des dates au format necessaire
        $date_debut = $date_debut->format('Y-m-j');
        $date_fin = $date_fin->format('Y-m-j');

        $prixtotal = $habitat->prix * $duree;

        //dd($prixtotal);

        return view('reservation.create', compact('habitat', 'date_debut', 'date_fin', 'nbpersonne', 'duree', 'prixtotal', 'typeHabitat'));


    }



    public function reservAccepterRefuser($id_reservation) {


    }

}
