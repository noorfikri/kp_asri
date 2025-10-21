<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Item $item)
    {
        return in_array($user->category, ['owner', 'staff']);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array($user->category, ['owner', 'staff']);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Item $item)
    {
        return in_array($user->category, ['owner', 'staff']);
    }

    /**
     * Determine whether the user can update the stock.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateStock(User $user)
    {
        return $user->category === 'owner';
    }
}