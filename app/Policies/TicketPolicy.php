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
        if (in_array($auth_user->role_id, [Role::BOSS, Role::EMPLOYEE])) return in_array(strtolower($status), ['waiting', 'processed', 'closed']);
        if (in_array($auth_user->role_id, [Role::CUSTOMER])) return in_array(strtolower($status), ['open', 'closed']);
        return false;
    }

    public function read(User $auth_user, Ticket $ticket)
    {
        if (in_array($auth_user->role_id, [Role::BOSS, Role::EMPLOYEE])) return true;
        return $auth_user->is($ticket->creating_user);
    }

    public function comment(User $auth_user, Ticket $ticket)
    {
        return strtolower($ticket->status()) !== 'closed' &&
            ($auth_user->is($ticket->creating_user) || $ticket->processing_users->contains($auth_user));
    }

    public function close(User $auth_user, Ticket $ticket)
    {
        return strtolower($ticket->status()) !== 'closed' &&
            ($auth_user->is($ticket->creating_user) || $ticket->processing_users->contains($auth_user) || $auth_user->role_id === Role::BOSS);
    }

    public function claim(User $auth_user, Ticket $ticket)
    {
        return strtolower($ticket->status()) === 'waiting' &&
            in_array($auth_user->role_id, [Role::EMPLOYEE]);
    }

    public function callin(User $auth_user, Ticket $ticket, User $user = null)
    {
        if (strtolower($ticket->status()) === 'closed') return false;
        if($ticket->processing_users->contains($auth_user) || $auth_user->role_id === Role::BOSS)
        {
            if (isset($user)) return $ticket->not_processing_users->contains($user);
            return true;
        }
        return false;
    }
}
