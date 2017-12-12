<?php

namespace App\Policies;

use App\Contact;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user, $ability){

    }

    public function manage(User $user, Contact  $contact){
        return $user->id == $contact->user_id;
    }
}
