<?php

namespace App\Policies;

use App\Models\Kas;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function only(User $user)
    {
        return $user->role === 'manager';
    }
}
