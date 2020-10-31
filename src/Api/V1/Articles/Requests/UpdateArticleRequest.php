<?php


namespace Api\V1\Articles\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    public function rules()
    {
        return [
            "title" => ["required", "string", "max:255"],
//            "cover_image" => ["nullable", "image", "max:2048"],
            "cover_image" => ["nullable", "string", "max:255"],
            "content" => ["required", "min:1", "max:10000"],
            "category_id" => ["required", "exists:categories,id"]
        ];
    }
}
