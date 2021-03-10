<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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

    public function read_user_info(User $auth_user, Comment $comment)
    {
        return  $auth_user->is($comment->user) ||
            in_array($auth_user->role_id, [Role::EMPLOYEE,Role::BOSS]);
    }
}
