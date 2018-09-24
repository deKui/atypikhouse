<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reservation;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function talkTo(User $user, User $to) {
        return $user->id !== $to->id;
    }

    public function canTalk(User $user, User $to) {
    	$reservation = Reservation::whereRaw("((id_locataire = " .$user->id. " AND id_proprietaire = " .$to->id. ") OR (id_locataire = " .$to->id. " AND id_proprietaire = " .$user->id. "))")->get();

    	return $reservation->isNotEmpty();
    }
}
