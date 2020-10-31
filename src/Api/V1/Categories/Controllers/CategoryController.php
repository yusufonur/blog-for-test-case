<?php

namespace Api\V1\Categories\Controllers;

use App\Http\Controllers\Controller;
use Api\V1\Categories\Models\Category;
use Api\V1\Categories\Requests\CategoryRequest;
use Api\V1\Categories\Resources\CategoryResource;
use Api\V1\Categories\Actions\StoreCategoryAction;
use Api\V1\Categories\Actions\UpdateCategoryAction;
use Api\V1\Categories\Actions\DestroyCategoryAction;
use Api\V1\Categories\DataTransferObjects\CategoryData;
use Support\ApiResponseFactory\ResponseFactoryInterface;
use Api\V1\Categories\Resources\CategoryResourceCollection;

class CategoryController extends Controller
{
    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->middleware(["role:" . config("role.admin")])
            ->except(["index", "show"]);

        $this->responseFactory = $responseFactory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::query()
            ->select(["id", "title", "slug"])
            ->with("tags")
            ->withCount("articles")
            ->paginate(20);

        return $this->responseFactory->setStatusCode(200)
            ->setData(new CategoryResourceCollection($categories))
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @param StoreCategoryAction $storeCategoryAction
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(
        CategoryRequest $request,
        StoreCategoryAction $storeCategoryAction
    ) {
        $categoryData = CategoryData::fromRequest($request);

        $category = $storeCategoryAction($categoryData, $request->input("tags"));

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("Kategori başarılı şekilde eklendi."))
            ->setData(new CategoryResource($category))
            ->get();
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        $category->loadCount("articles")
            ->only(["id", "title", "slug"]);

        return $this->responseFactory->setStatusCode(200)
            ->setData(new CategoryResource($category))
            ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @param UpdateCategoryAction $updateCategoryAction
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update(
        CategoryRequest $request,
        Category $category,
        UpdateCategoryAction $updateCategoryAction
    ) {
        $categoryData = CategoryData::fromRequest($request);

        $category = $updateCategoryAction($category, $categoryData, $request->input("tags"));

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("Kategori başarılı şekilde güncellendi."))
            ->setData(new CategoryResource($category))
            ->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @param DestroyCategoryAction $destroyCategoryAction
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy(
        Category $category,
        DestroyCategoryAction $destroyCategoryAction
    ) {
        $destroyCategoryAction($category);

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("Kategori başarılı şekilde silindi."))
            ->get();
    }
}
