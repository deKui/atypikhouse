<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Note;
use App\Models\Avis;
use App\Models\TypeHabitats;
use App\Models\Habitat;
use App\Models\Reservation;
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
    	$typeHabitat = TypeHabitats::all();

        if (Auth::id() !== intval($id_user)) {
            return redirect('/')->with(['ok' => __("Vous n'avez pas accès à cette page !")]);
        }

        $user = $this->user->getUser($id_user);

        return view('profil.index', compact('user', 'typeHabitat'));	
    }

    /**
     * Auteur : Lucas
     * Affiche le profil public d'un utilisateur à partir d'un pseudo 
     */
    public function show(User $user) 
    {
        $typeHabitat = TypeHabitats::all();

        $users = User::find($user->id);

        $reservations = Reservation::whereRaw("((id_locataire = " .$user->id. " AND id_proprietaire = " .Auth::id(). ") OR (id_locataire = " .Auth::id(). " AND id_proprietaire = " .$user->id. "))")->get();
        
        return view('profil.show', compact('users', 'reservations', 'typeHabitat'));

    }

    /**
     * Auteur : Lucas
     * Affiche la page pour noter un utilisateur
     */
    public function noter(User $user) 
    {
        $typeHabitat = TypeHabitats::all();

        $users = User::find($user->id);

        $notes = Note::where('from_id', Auth()->user()->id)->where('to_id', $user->id)->first();

        // Si aucune note de la part de l'utilisateur connecté pour l'user
        if ($notes == []) {
            return view('profil.noter', compact('users', 'typeHabitat'));

        // Sinon cela veut dire que l'utilisateur connecté à déjà noté cet user        
        }else {
            return redirect('profil/' . $user->id)->with(['ok' => __('Vous avez déjà noté cet utilisateur !')]); 
        }   
    }

    /**
     * Auteur : Lucas
     * Note un utilisateur
     */
    public function eval(Request $request, User $user) 
    {
        // User qui met la note
        $from_id = Auth()->user()->id;

        // User noté
        $to_id = User::find($user->id);

        $request->validate([
            'note' => 'required|integer|max:5',
        ]);

        // Ajout d'une nouvelle note
        Note::create([
            'from_id' => $from_id,
            'to_id' => $to_id->id,
            'note' => $request->note,
        ]);

        // On récupère toutes les notes qu'a reçu l'utilisateur
        $notes = $this->user->getNote($to_id->id);

        $tab_note = [];

        // On récupère unique le champ note pour les mettre dans un tableau 
        foreach ($notes as $note) {
            array_push($tab_note, $note->note);
        }

        // On calcule la moyenne de toute les notes
        $moyenne_note = array_sum($tab_note) / count($tab_note);

        // On met à jour la note de l'user
        $to_id->update([
            'note_eval' => round($moyenne_note, 2)
        ]);

        // sauvegarde dans la bdd
        $to_id->save();
        
        return redirect('profil/public/' . $user->id);   
    }



    /**
     * Auteur : Lucas
     * Affiche la page pour éditer son profil
     */
    public function edit($id_user) 
    {
    	$typeHabitat = TypeHabitats::all();

        $user = $this->user->getUser($id_user);

    	return view('profil.edit', compact('user', 'typeHabitat'));	
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

   /**
     * Auteur : Valériane
     * Update utilisateur signale
     */
    public function updateSignale($id_user) 
    {
        $user = $this->user->getUser($id_user);

        // on remplace les anciens champs par les nouveaux dans la bdd
        $user->update([
            'signale' => true,
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
    public function showInfoGerant() {

        $typeHabitat = TypeHabitats::all(); 

        $userSignale = $this->user->getUserSignale();

        $avisSignale = $this->user->getAvisSignale();

        $habitatSignale = $this->user->getHabitatSignale();

        $typeHabitats = TypeHabitats::all();

        return view('profil.gerant', compact('userSignale','avisSignale','habitatSignale', 'typeHabitats', 'typeHabitat')); 

    }

    /**
     * Auteur : Valériane
     * Active ou désactive les utilisateurs
     */
    public function updateActiveDesactiveUser($id_user) 
    {
        $user = $this->user->getUser($id_user); 
        // on remplace les anciens champs par les nouveaux dans la bdd
       
        if($user->active == true){
                    $user->update([
            'active' => false
        ]);
        }
        elseif ($user->active == false){

                    $user->update([
            'active' => true
        ]);
        }
        // Enregistre les modifications de la bdd
        $user->save();
        return redirect('gerant'); 

    }

/****** FIN GERANT ******/

}
