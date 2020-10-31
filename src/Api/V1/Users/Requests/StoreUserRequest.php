<?php


namespace Api\V1\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            "name" => ["required"],
            "email" => ["required", "email", "unique:users,email"],
            "password" => ["required"],
            "password_confirmation" => ["required", "same:password"],
            "role" => ["nullable", "exists:".config("permission.models.role").",name"]
        ];
    }
}
