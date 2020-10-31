<?php


namespace Api\V1\Users\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            "email" => ["required", "email"],
            "password" => ["required"]
        ];
    }
}
