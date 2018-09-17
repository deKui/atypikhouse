<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Planning;
use App\Models\Reservation;

class PlanningController extends Controller
{
    
	/**
	 * Affiche le calendrier
	 * @param  int $month 
	 * @param  int $year
	 * @return Planning
	 */
	public function index($month, $year) {

		$planning = new Planning($month, $year);

		$reservations = new Reservation();

		$start = $planning->getStartingDay();

		$start = $start->format('N') === '1' ? $start : $planning->getStartingDay()->modify('last monday');

		$weeks = $planning->getWeeks();

		$end = (clone $start)->modify('+' . (6 + 7 * ($weeks -1)) . 'days');

		$reservations = $reservations->getReservBetweenByDay($start, $end);

    	return view('planning.index', compact('planning', 'start', 'weeks', 'reservations'));
    }
}
