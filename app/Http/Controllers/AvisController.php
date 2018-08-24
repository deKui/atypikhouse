<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AvisRequest;
use App\Models\User;
use App\Models\Habitat;
use App\Models\Avis;

class AvisController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Auteur : lucas
     * Création d'un nouvel avis
     *
     * @param $user
     * @param $habitat
     * @return \Illuminate\Http\Response
     */
    public function store(AvisRequest $request, Habitat $habitat)
    {
        Avis::create([
            'id_utilisateur' => Auth::user()->id,
            'id_habitat' => $habitat->id,
            'comment' => $request->comment,
            'note' => $request->note,
        ]);

        return redirect(route('habitat.show', ['id' => $habitat->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
