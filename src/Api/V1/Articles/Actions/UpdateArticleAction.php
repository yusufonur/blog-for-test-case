<?php


namespace Api\V1\Articles\Actions;


use Api\V1\Articles\Models\Article;
use Api\V1\Articles\DataTransferObjects\ArticleData;
use Support\ImageManager\ImageManager;

class UpdateArticleAction
{
    public function __invoke(Article $article, ArticleData $articleData, ?string $tags = null): Article
    {
        $data = [
            "title" => $articleData->title,
            "cover_image" => $articleData->cover_image,
            "content" => $articleData->content,
            "category_id" => $articleData->category_id,
            "writer_id" => $articleData->writer_id
        ];

        if ($articleData->cover_image) {
            $data["cover_image"] = $articleData->cover_image;

            $imageManager = new ImageManager();
            $imageManager->delete($article->cover_image);
        }

        $article->fill($data)->save();

        if ($tags) {
            $article->tag($tags);
        }

        return $article->refresh()
            ->load([
                "category",
                "writer",
                "tags"
            ]);
    }
}
