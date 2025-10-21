<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Report;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Report $report)
    {
        return $user->category === 'owner';
    }
}
