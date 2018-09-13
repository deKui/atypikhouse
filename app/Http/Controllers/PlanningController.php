<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Planning;

class PlanningController extends Controller
{
    
	public function index() {

		$month = new Planning();

    	return view('planning.index', compact('month'));
    }
}
