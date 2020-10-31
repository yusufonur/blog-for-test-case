<?php


namespace Api\V1\Categories\Actions;


use Api\V1\Categories\DataTransferObjects\CategoryData;
use Api\V1\Categories\Models\Category;

class StoreCategoryAction
{
    public function __invoke(CategoryData $categoryData, ?string $tags = null): Category
    {
        $category = Category::create([
            "title" => $categoryData->title
        ]);

        if ($tags) {
            $category->tag($tags);
        }

        return $category;
    }
}
