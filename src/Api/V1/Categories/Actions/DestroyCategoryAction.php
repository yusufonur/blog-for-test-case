<?php


namespace Api\V1\Categories\Actions;


use Api\V1\Categories\Models\Category;

class DestroyCategoryAction
{
    public function __invoke(Category $category)
    {
        $category->detag();

        return $category->delete();
    }
}
