<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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

    public function userManagementAccess(User $user){
        return ($user->category == "owner" ? Response::allow() : Response::deny('Anda tidak memiliki akses untuk mengelola akun'));
    }
}
