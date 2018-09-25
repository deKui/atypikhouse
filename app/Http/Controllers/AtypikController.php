<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeHabitats;

class AtypikController extends Controller
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
    public function showcgu()
    {
        $typeHabitat = TypeHabitats::all();

        return view('atypik.cgu', compact('typeHabitat'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcgv()
    {
        $typeHabitat = TypeHabitats::all();

        return view('atypik.cgv', compact('typeHabitat'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showlegal()
    {
        $typeHabitat = TypeHabitats::all();

        return view('atypik.legal', compact('typeHabitat'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcontact()
    {
        $typeHabitat = TypeHabitats::all();

        return view('atypik.contact', compact('typeHabitat'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showabout()
    {
        $typeHabitat = TypeHabitats::all();

        return view('atypik.about', compact('typeHabitat'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showbehost()
    {
        $typeHabitat = TypeHabitats::all();

        return view('atypik.behost', compact('typeHabitat'));
    }
}