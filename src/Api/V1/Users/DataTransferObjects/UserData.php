<?php


namespace Api\V1\Users\DataTransferObjects;


use Api\V1\Users\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UserData extends DataTransferObject
{
    public string $name;

    public string $email;

    public ?string $password;


    public static function fromRequest(Request $request): UserData
    {
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "password" => null
        ];

        if ($request->input("password")) {
            $data["password"] = Hash::make($request->password);
        }

        return new self($data);
    }
}
