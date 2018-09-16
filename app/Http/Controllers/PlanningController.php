<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Planning;

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

		$start = $planning->getStartingDay()->modify('last monday');

    	return view('planning.index', compact('planning', 'start'));
    }
}
