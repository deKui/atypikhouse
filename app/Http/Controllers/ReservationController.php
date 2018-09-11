<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $reservation = $this->reservation->getReservation($id_locataire);
        
        return view('reservation.index', compact('reservation'));
    }

    /**
     * Affiche les réservation à partir d'un utilisateur
     */
    public function show() {
        //
    }


    /**
     * Auteur : Lucas
     * Enregistre la réservation
     */
    public function create(Habitat $habitat, ReservationRequest $request) {
        $id_locataire = Auth()->user()->id;
        $id_habitat = $habitat->id;

        $montant = $request->nb_personne * $habitat->prix;

        Reservation::create([
            'id_locataire' => $id_locataire,
            'id_habitat' => $id_habitat,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'montant' => $montant
        ]);

        return redirect('habitats/' . $habitat->id)->with(['ok' => __("Votre réservation d'un montant de " . $montant . " euros a bien été pris en compte !")]);
    }

}
