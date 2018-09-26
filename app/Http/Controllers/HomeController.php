<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitat;
use App\Models\TypeHabitats;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeHabitat = TypeHabitats::all();

        return view('home', compact('typeHabitat'));
    }
}
