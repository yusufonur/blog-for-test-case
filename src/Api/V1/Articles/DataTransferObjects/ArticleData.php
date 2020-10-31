<?php


namespace Api\V1\Articles\DataTransferObjects;


use Api\V1\Articles\Requests\UpdateArticleRequest;
use Api\V1\Users\Models\User;
use Api\V1\Categories\Models\Category;
use Api\V1\Articles\Requests\StoreArticleRequest;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Support\ImageManager\ImageManager;

class ArticleData extends DataTransferObject
{
    public string $title;

    public ?string $cover_image;

    public string $content;

    public $category_id;

    public $writer_id;

    public static function fromRequest(Request $request): ArticleData
    {
//        $imageManager = new ImageManager();
//        $image = $imageManager->uploadImageFromRequest($request);

        return new self([
            "title" => $request->input("title"),
            "cover_image" => $request->input("cover_image"),
            "content" => $request->input("content"),
            "category_id" => $request->input("category_id"),
            "writer_id" => $request->user()->id
        ]);
    }
}
