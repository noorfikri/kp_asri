<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SellingTransaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class SellingTransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SellingTransaction $sellingTransaction)
    {
        return $user->category === 'owner';
    }
}
