<?php


namespace Api\V1\Articles\Actions;


use Api\V1\Articles\Models\Article;
use Support\ImageManager\ImageManager;

class DestroyArticleAction
{
    public function __invoke(Article $article): void
    {
        $article->detag();

        $image = $article->cover_image;

        $article->delete();

//        $imageManager = new ImageManager();
//        $imageManager->delete($image);
    }


}
