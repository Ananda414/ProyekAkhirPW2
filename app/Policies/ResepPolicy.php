<?php

namespace App\Policies;

use App\Models\Resep;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ResepPolicy
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
    public function view(User $user, Resep $resep)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return in_array($user->email, [
            'wijayaananda414@gmail.com',
            'wijayaananda@gmail.com',
            'erlinaoktavianny@gmail.com',
            'iqlimaruliyani@gmail.com',
            'arbainaji@gmail.com',
            'oliviarachmi@gmail.com',
            'sriwahyuni@gmail.com',
            'dwirizki@gmail.com',
            'mekametroza@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return in_array($user->email, [
            'wijayaananda414@gmail.com',
            'wijayaananda@gmail.com',
            'erlinaoktavianny@gmail.com',
            'iqlimaruliyani@gmail.com',
            'arbainaji@gmail.com',
            'oliviarachmi@gmail.com',
            'sriwahyuni@gmail.com',
            'dwirizki@gmail.com',
            'mekametroza@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return in_array($user->email, [
            'wijayaananda414@gmail.com',
            'wijayaananda@gmail.com'
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Resep $resep)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Resep $resep)
    {
        //
    }
}
