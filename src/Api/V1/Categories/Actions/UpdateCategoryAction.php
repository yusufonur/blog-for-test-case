<?php


namespace Api\V1\Categories\Action;


use Api\V1\Categories\DataTransferObject\CategoryData;
use Api\V1\Categories\Models\Category;

class UpdateCategoryAction
{
    public function __invoke(Category $category, CategoryData $categoryData)
    {
        $category->fill([
            "title" => $categoryData->title
        ])->save();

        return $category->refresh();
    }
}
