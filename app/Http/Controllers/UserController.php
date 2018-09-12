<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Note;
use App\Models\Avis;
use App\Models\Habitat;
use App\Http\Requests\UserRequest;

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
     * Affiche le profil public d'un utilisateur à partir d'un pseudo 
     */
    public function show(User $user) 
    {
        $users = User::find($user->id);
        
        return view('profil.show', compact('users'));   
    }

    /**
     * Auteur : Lucas
     * Affiche la page pour noter un utilisateur
     */
    public function noter(User $user) 
    {
        $users = User::find($user->id);
        
        return view('profil.noter', compact('users'));   
    }

    /**
     * Auteur : Lucas
     * Note un utilisateur
     */
    public function eval(Request $request, User $user) 
    {
        $from_id = Auth()->user()->id;

        $to_id = User::find($user->id);

        $request->validate([
            'note' => 'required|integer|max:5',
        ]);

        

        $to_id->save();

        //dd($to_id);
        
        return redirect('profil/' . $user->id);   
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
    public function update(UserRequest $request, $id_user) 
    {
        $user = $this->user->getUser($id_user);

        $avatar = Storage::disk('public')->put('', $request->file('avatar'));
        
        // on remplace les anciens champs par les nouveaux dans la bdd
        $user->update([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'avatar' => $avatar,
        ]);
        
        // Enregistre les modifications de la bdd
        $user->save();

    	return redirect('profil/' . $user->id);	
    }


/****** GERANT ******/

    /**
     * Auteur : Valériane
     * Affiche les infos sur la page gérant
     */
    public function showInfoGerant(){

        $userSignale = $this->user->getUserSignale();

        $avisSignale = $this->user->getAvisSignale();

        $habitatSignale = $this->user->getHabitatSignale();

        return view('profil.gerant', compact('userSignale','avisSignale','habitatSignale')); 

    }


    public function updateActiveDesactiveUser($id_user) 
    {
        $user = $this->user->getUser($id_user); 
        // on remplace les anciens champs par les nouveaux dans la bdd
        $user->update([
            'active' => false
        ]);
        
        // Enregistre les modifications de la bdd
        $user->save();
        return redirect('profil.gerant'); 

    }
/****** FIN GERANT ******/

}
