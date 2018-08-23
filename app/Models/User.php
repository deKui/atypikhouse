<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo', 'prenom', 'nom', 'email', 'password', 'date_naissance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Auteur : Lucas
     * Retourne un user à partir de son id
    */
    public function getUser($id_user)
    {
        $user = User::where('id', $id_user)->first();

        return $user;
    }


    /**
     * Auteur : Lucas
     * Retourne un user à partir de son nom
    */
    public function getUserByName($name_user)
    {
        $user = User::where('name', $name_user)->first();

        return $user;
    }
}
