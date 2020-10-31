<?php


namespace Api\V1\Articles\Controllers;


use Api\V1\Articles\Models\Article;
use App\Http\Controllers\Controller;
use Api\V1\Articles\Resources\ArticleResource;
use Api\V1\Articles\Actions\StoreArticleAction;
use Api\V1\Articles\Actions\UpdateArticleAction;
use Api\V1\Articles\Actions\DestroyArticleAction;
use Api\V1\Articles\Requests\StoreArticleRequest;
use Api\V1\Articles\Requests\UpdateArticleRequest;
use Api\V1\Articles\DataTransferObjects\ArticleData;
use Api\V1\Articles\Resources\ArticleResourceCollection;
use Support\ApiResponseFactory\ResponseFactoryInterface;

class ArticleController extends Controller
{

    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->middleware(["role:" . config("role.admin") . "|" . config("role.writer")])
            ->except(["index", "show"]);

        $this->middleware(["verify_article_owner"])
            ->only("update", "destroy");

        $this->responseFactory = $responseFactory;
    }

    public function index()
    {
        $articles = Article::query()
            ->orderBy("id", "DESC")
            ->withRelations()
            ->paginate(20);

        return $this->responseFactory->setStatusCode(200)
            ->setData(new ArticleResourceCollection($articles))
            ->get();
    }

    public function store(
        StoreArticleRequest $request,
        StoreArticleAction $storeArticleAction
    ) {
        $articleData = ArticleData::fromRequest($request);

        $article = $storeArticleAction($articleData, $request->input("tags"));

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("İçerik başarılı şekilde eklendi."))
            ->setData(new ArticleResource($article))
            ->get();
    }

    public function show(Article $article)
    {
        $article->load([
            "category",
            "writer",
            "tags"
        ]);

        return $this->responseFactory->setStatusCode(200)
            ->setData(new ArticleResource($article))
            ->get();
    }

    public function update(
        UpdateArticleRequest $request,
        Article $article,
        UpdateArticleAction $updateArticleAction
    ) {
        $articleData = ArticleData::fromRequest($request);

        $article = $updateArticleAction($article, $articleData, $request->input("tags"));

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("İçerik başarılı şekilde güncellendi."))
            ->setData(new ArticleResource($article))
            ->get();
    }

    public function destroy(
        Article $article,
        DestroyArticleAction $destroyArticleAction
    ) {
      $destroyArticleAction($article);

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("İçerik başarılı şekilde silindi."))
            ->get();

    }
}
