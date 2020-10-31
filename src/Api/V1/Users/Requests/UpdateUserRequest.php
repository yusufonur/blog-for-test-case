<?php


namespace Api\V1\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $user = $this->route("user");

        return [
            "name" => ["required"],
            "email" => ["required", "email", "unique:users,email," . $user->id],
            "password" => ["nullable"],
            "password_confirmation" => ["nullable", "same:password"],
            "role" => ["nullable", "exists:".config("permission.models.role").",name"]
        ];
    }
}
