<?php


namespace Api\V1\Users\Actions;


use Api\V1\Users\DataTransferObjects\UserData;
use Api\V1\Users\Models\User;

class StoreUserAction
{
    public function __invoke(UserData $userData, $role = null): User
    {
        $user = User::create([
            "name" => $userData->name,
            "email" => $userData->email,
            "password" => $userData->password
        ]);

        if ($role) {
            $user->assignRole($role);
        }

        return $user;
    }
}
