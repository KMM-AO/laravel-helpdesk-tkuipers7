<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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

    public function create(User $auth_user)
    {
        return $auth_user->role_id == Role::CUSTOMER;
    }

    public function list(User $auth_user)
    {
        return in_array($auth_user->role_id, [Role::BOSS, Role::EMPLOYEE, Role::CUSTOMER]);
    }

    public function click_list(User $auth_user, $status)
    {
        if (in_array($auth_user->role_id, [Role::BOSS, Role::EMPLOYEE])) return in_array($status, ['waiting', 'processed', 'closed']);
        if (in_array($auth_user->role_id, [Role::CUSTOMER])) return in_array($status, ['open', 'closed']);
        return false;
    }

    public function read_employee_names(User $auth_user)
    {
        return in_array($auth_user->role_id, [Role::BOSS, Role::EMPLOYEE]);
    }
}
