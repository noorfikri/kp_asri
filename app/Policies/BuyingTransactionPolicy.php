<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BuyingTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuyingTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, BuyingTransaction $buyingTransaction)
    {
        return $user->category === 'owner';
    }
}
