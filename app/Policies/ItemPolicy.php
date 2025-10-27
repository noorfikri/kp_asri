<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Item;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
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
    public function update(User $user, Item $item)
    {
        return in_array($user->category, ['owner', 'staff']);
    }

    public function create(User $user)
    {
        return in_array($user->category, ['owner', 'staff']);
    }

    public function delete(User $user, Item $item)
    {
        return in_array($user->category, ['owner', 'staff']);
    }

    public function updateStock(User $user)
    {
        return $user->category === 'owner';
    }
}
