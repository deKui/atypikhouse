<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $user;

    /**
     * Auteur : Lucas
     * Create a new HabitatController instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Auteur : Lucas
     * Affiche le profil privé à partir d'un id
     */
    public function index($id_user) 
    {
    	$user = $this->user->getUser($id_user);

    	return view('profil.index', compact('user'));	
    }


    /**
     * Auteur : Lucas
     * Affiche le profil public d'un utilisateur à partir d'un pseudo (à faire)
     */
    public function show($user_name) 
    {
        $user = $this->user->getUserByName($user_name);

        return view('profil.show', compact('user'));   
    }


    /**
     * Auteur : Lucas
     * Affiche la page pour éditer son profil
     */
    public function edit($id_user) 
    {
    	$user = $this->user->getUser($id_user);

    	return view('profil.edit', compact('user'));	
    }


    /**
     * Auteur : Lucas
     * Modification des informations du profil
     */
    public function update(Request $request, $id_user) 
    {
        // Vérification des nouvelles informations 
    	$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = $this->user->getUser($id_user);
        
        // on remplace les anciens champs par les nouveaux dans la bdd
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        // Enregistre les modifications de la bdd
        $user->save();

        //dd($user);

    	return redirect('profil/' . $user->id);	
    }
}
