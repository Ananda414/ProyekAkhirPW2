<?php

namespace App\Policies;

use App\Models\Tim;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TimPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Tim $tim)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return in_array($user->email, [
            'ananda1@gmail.com',
            'ananda2@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return in_array($user->email, [
            'ananda1@gmail.com',
            'ananda2@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return in_array($user->email, [
            'ananda1@gmail.com',
            'ananda2@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Tim $tim)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Tim $tim)
    {
        //
    }
}
