<?php


namespace Api\V1\Articles\QueryBuilders;


use Illuminate\Database\Eloquent\Builder;

class ArticleQueryBuilder extends Builder
{
    public function withRelations(): self
    {
        return $this->with([
            "category",
            "writer",
            "tags"
        ]);
    }
}
