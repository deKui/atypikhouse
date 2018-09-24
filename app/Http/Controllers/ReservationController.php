<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DateTime;
use App\Models\Habitat;
use App\Models\Reservation;
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
        $reservPassee = $this->reservation->getReservationPassee($id_locataire);
        
        $reservFuture = $this->reservation->getReservationFuture($id_locataire);

        return view('reservation.index', compact('reservPassee', 'reservFuture'));
    }

    /**
     * Affiche les réservation à partir d'un utilisateur
     */
    public function show() {
        //
    }


    /**
     * Auteur : Lucas
     * Enregistre la réservation en testant sa disponibilité
     */
    public function create(Habitat $habitat, ReservationRequest $request) {
        $id_locataire = Auth()->user()->id;
        $id_habitat = $habitat->id;

        // montant calculé en fonction du nb de personne par nuit
        $montant = $request->nb_personne * $habitat->prix;

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

        // tous les cas de non disponibilité étant passés, la réservation est créé
        Reservation::create([
            'id_locataire' => $id_locataire,
            'id_habitat' => $id_habitat,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant' => $montant,
            'statut' => 'accepted' // VAL  - réservation accepté par defaut
        ]);

        return redirect('habitats/' . $habitat->id)->with(['ok' => __("Votre réservation d'un montant de " . $montant . " euros a bien été pris en compte !")]);
    }



    public function reservAccepterRefuser($id_reservation) {


    }

}
