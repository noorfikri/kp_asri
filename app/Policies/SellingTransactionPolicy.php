<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SellingTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellingTransactionPolicy
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

    public function delete(User $user, SellingTransaction $sellingTransaction)
    {
        return $user->category === 'owner';
    }
}
