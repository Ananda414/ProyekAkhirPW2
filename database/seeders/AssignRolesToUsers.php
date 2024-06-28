<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesToUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $users = User::all();

        foreach ($users as $user) {
            // Check the user's email to determine the role
            if ($user->email == 'wijayaananda@gmail.com' || $user->email == 'oliviarachmi@gmail.com'
                || $user->email == 'lindafachrudin@gmail.com' || $user->email == 'erlinaoktavianny@gmail.com'
                || $user->email == 'arbainaji@gmail.com' || $user->email == 'sriwahyuni@gmail.com'
                || $user->email == 'dwirizki@gmail.com' || $user->email == 'mekametroza@gmail.com') {
                // Assign the 'admin' role
                $user->assignRole(Role::findByName('admin'));
            } else {
                // Assign the 'user' role
                $user->assignRole(Role::findByName('user'));
            }
        }
    }
}