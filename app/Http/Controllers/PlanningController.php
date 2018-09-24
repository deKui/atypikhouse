<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Planning;
use App\Models\Habitat;
use App\Models\Reservation;

class PlanningController extends Controller
{
    
	/**
	 * Affiche le calendrier
	 * @param  int $month 
	 * @param  int $year
	 * @return Planning
	 */
	public function index(int $month, int $year) {

		$planning = new Planning($month, $year);

		$reservation = new Reservation();

		$start = $planning->getStartingDay();

		$start = $start->format('N') === '1' ? $start : $planning->getStartingDay()->modify('last monday');

		$weeks = $planning->getWeeks();

		$end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . 'days');

		$reservations = $reservation->getReservBetweenByDayByUser(Auth::id(), $start, $end);

    	return view('planning.index', compact('planning', 'start', 'weeks', 'reservations'));
    }


    /**
     * Affiche le calendrier pour un habitat
     * @param  Habitat $habitat [description]
     * @param  int     $month   [description]
     * @param  int     $year    [description]
     * @return 
     */
    public function show(Habitat $habitat, int $month, int $year) {

		$planning = new Planning($month, $year);

		$weeks = $planning->getWeeks();

		$reservation = new Reservation();

		$start = $planning->getStartingDay();

		$start = $start->format('N') === '1' ? $start : $planning->getStartingDay()->modify('last monday');

		$reservations = $reservation->getReservByDayByHabitat($habitat);

    	return view('planning.show', compact('habitat', 'planning', 'start', 'weeks', 'reservations'));
    }
}
