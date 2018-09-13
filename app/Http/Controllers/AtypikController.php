<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('atypik.cgu');
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcgv()
    {
        return view('atypik.cgv');
    }

            /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showlegal()
    {
        return view('atypik.legal');
    }

                /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showcontact()
    {
        return view('atypik.contact');
    }

                    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showabout()
    {
        return view('atypik.about');
    }

                        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showbehost()
    {
        return view('atypik.behost');
    }
}