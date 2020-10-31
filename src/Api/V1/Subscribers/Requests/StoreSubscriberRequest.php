<?php


namespace Api\V1\Subscribers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class SubscriberStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            "email" => ["required", "email", "max:255"],
            "name" => ["string", "max:255"]
        ];
    }
}
