<?php

namespace App\Policies;

use App\Models\Applicant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicantPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function list(User $user)
    {
        return $user->role_id == Role::BOSS;
    }

    public function employ(User $auth_user, Applicant $applicant)
    {
        return
            $auth_user->role_id == Role::BOSS
            &&
            $applicant->user->role_id == Role::APPLICANT;
    }
}
