<?php


namespace Api\V1\Articles\Actions;


use Api\V1\Articles\DataTransferObjects\ArticleData;
use Api\V1\Articles\Models\Article;

class StoreArticleAction
{
    public function __invoke(ArticleData $articleData, ?string $tags = null): Article
    {
        $article = Article::create([
            "title" => $articleData->title,
            "cover_image" => $articleData->cover_image,
            "content" => $articleData->content,
            "category_id" => $articleData->category_id,
            "writer_id" => $articleData->writer_id
        ]);

        if ($tags) {
            $article->tag($tags);
        }

        return $article->load([
            "category",
            "writer",
            "tags"
        ]);
    }
}
