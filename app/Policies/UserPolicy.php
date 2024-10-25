<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function IsAdmin(User $user)
    {
        return $user->role === 'admin'; // Memeriksa apakah pengguna adalah admin
    }

    public function IsCustomer(User $user)
    {
        return $user->role === 'customer'; // Memeriksa apakah pengguna adalah customer
    }
    public function IsSuper(User $user)
    {
        return $user->role === 'super admin'; // Memeriksa apakah pengguna adalah customer
    }
}
