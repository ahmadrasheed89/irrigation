<?php

namespace App\Policies;

use App\Models\Adp;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AdpPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Adp $adp): bool
    {
        return $user->id === $adp->user_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Adp $adp): bool
    {
        return $user->id === $adp->user_id;
    }

    public function delete(User $user, Adp $adp): bool
    {
        return $user->id === $adp->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Adp $adp): bool
    {
        return false;
    }
}
