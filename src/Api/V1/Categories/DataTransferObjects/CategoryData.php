<?php


namespace Api\V1\Categories\DataTransferObject;


use Api\V1\Categories\Requests\CategoryRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CategoryData extends DataTransferObject
{
    public string $title;

    public static function fromRequest(CategoryRequest $request): CategoryData
    {
        return new self([
            "title" => $request->input("title")
        ]);
    }
}
