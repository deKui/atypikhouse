<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;

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


    }

}
