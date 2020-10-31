<?php


namespace Api\V1\Users\Actions;


use Api\V1\Users\Models\User;

class DestroyUserAction
{
    public function __invoke(User $user)
    {
        $user->roles()->detach();

        return $user->delete();
    }
}
