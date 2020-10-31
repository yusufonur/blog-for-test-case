<?php


namespace Api\V1\Users\Actions;


use Api\V1\Users\Models\User;
use Api\V1\Users\DataTransferObjects\UserData;

class UpdateUserAction
{
    public function __invoke(UserData $userData, User $user, $role = null)
    {
        $data = [
            "name" => $userData->name,
            "email" => $userData->email
        ];

        if ($userData->password) {
            $data["password"] = $userData->password;
        }

        $user->update($data);

        if ($role) {
            $user->syncRoles($role);
        }

        return $user->refresh();
    }
}
