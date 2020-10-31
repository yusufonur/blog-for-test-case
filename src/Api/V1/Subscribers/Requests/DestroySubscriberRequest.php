<?php


namespace Api\V1\Subscribers\Requests;


use Illuminate\Foundation\Http\FormRequest;

class DestroySubscriberRequest extends FormRequest
{
    public function rules()
    {
        return [
            "email" => ["required", "email", "exists:subscribers,email"]
        ];
    }
}
