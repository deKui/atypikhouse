<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Auteur : lucas
     * Affiche la page des messages entre deux utilisateurs
     */
    public function conversation($name_proprio, $id_user)
    {
        $user = User::where('name', $name_proprio)->first();

        $messages = Message::where('id_utilisateur', $id_user)->where('id_proprietaire', $user->id)->get();

        //dd($messages);

        return view('messages.conversation', compact('user', 'messages'));
    }


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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_proprio, $id_user)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Message::create([
            'id_utilisateur' => $id_user,
            'id_proprietaire' => $id_proprio,
            'content' => $request->content,
        ]);

        $messages = Message::where('id_utilisateur', $id_user)->where('id_proprietaire', $id_proprio)->get();

        $user = User::where('id', $id_user)->first();

        return view('messages.conversation', compact('messages', 'user'));
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
