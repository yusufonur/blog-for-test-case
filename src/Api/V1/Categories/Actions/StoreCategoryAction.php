<?php


namespace Api\V1\Categories\Action;


use Api\V1\Categories\DataTransferObject\CategoryData;
use Api\V1\Categories\Models\Category;

class StoreCategoryAction
{
    public function __invoke(CategoryData $categoryData): Category
    {
        return Category::create([
            "title" => $categoryData->title
        ]);
    }
}
