<?php


namespace Api\V1\Categories\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
{
    public function authorize(Request $request)
    {
        return true;
    }

    public function rules()
    {
        return [
            "title" => ["required", "max:255"],
        ];
    }
}
