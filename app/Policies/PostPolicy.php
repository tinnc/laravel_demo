<?php

namespace App\Policies;

use App\Models\User;
use App\Models\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
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
    public function index(User $user, News $new)
    {
        return $user->id === $new->user_id;
    }
    public function create(User $user, News $new)
    {
        return $user->id === $new->user_id;
    }
    public function store(User $user, News $new)
    {
        return $user->id === $new->user_id;
    }
    public function show(User $user, News $new)
    {
        if (strcmp($user->role_format, 'User') !=0 || $user->id !== $new->user_id) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function edit(User $user, News $new)
    {
        if (strcmp($user->role_format, 'User') !=0 || $user->id !== $new->user_id) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function update(User $user, News $new)
    {
        if (strcmp($user->role_format, 'User') !=0 || $user->id !== $new->user_id) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
    public function destroy(User $user, News $new)
    {
        if (strcmp($user->role_format, 'User') !=0 || $user->id !== $new->user_id) {
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
