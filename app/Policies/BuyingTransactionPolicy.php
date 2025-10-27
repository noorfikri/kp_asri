<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BuyingTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyingTransactionPolicy
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

    public function delete(User $user, BuyingTransaction $buyingTransaction)
    {
        return $user->category === 'owner';
    }
}
