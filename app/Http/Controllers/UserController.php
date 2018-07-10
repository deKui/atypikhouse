<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $user;

    /**
     * Create a new HabitatController instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Affiche le profil à partir d'un id
     */
    public function index($id_user) 
    {
    	$user = $this->user->getUser($id_user);

    	return view('profil.index', compact('user'));	
    }


    /**
     * Affiche la page pour éditer son profil
     */
    public function edit($id_user) 
    {
    	$user = $this->user->getUser($id_user);

    	return view('profil.edit', compact('user'));	
    }


    /**
     * Modification des informations du profil
     */
    public function update(Request $request, $id_user) 
    {
    	$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = $this->user->getUser($id_user);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->save();

        //dd($user);

    	return redirect('profil/' . $user->id);	
    }
}
