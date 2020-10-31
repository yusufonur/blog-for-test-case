<?php


namespace Api\V1\Categories\Actions;


use Api\V1\Categories\DataTransferObjects\CategoryData;
use Api\V1\Categories\Models\Category;

class UpdateCategoryAction
{
    public function __invoke(Category $category, CategoryData $categoryData, ?string $tags = null): Category
    {
        $category->fill([
            "title" => $categoryData->title
        ])->save();

        if ($tags) {
            $category->tag($tags);
        }

        return $category->refresh()
            ->load("tags")
            ->loadCount("articles");
    }
}
