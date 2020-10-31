<?php


namespace Api\V1\Users\Controllers;


use Api\V1\Users\Models\User;
use App\Http\Controllers\Controller;
use Api\V1\Users\Resources\UserResource;
use Api\V1\Users\Actions\StoreUserAction;
use Api\V1\Users\Actions\UpdateUserAction;
use Api\V1\Users\Requests\StoreUserRequest;
use Api\V1\Users\Actions\DestroyUserAction;
use Api\V1\Users\Requests\UpdateUserRequest;
use Api\V1\Users\DataTransferObjects\UserData;
use Api\V1\Users\Resources\UserResourceCollection;
use Support\ApiResponseFactory\ResponseFactoryInterface;

class UserController extends Controller
{

    /**
     * @var ResponseFactoryInterface
     */
    private ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    public function index()
    {
        $users = User::query()
            ->with("roles")
            ->withCount("articles")
            ->paginate(20);

        return $this->responseFactory->setStatusCode(200)
            ->setData(new UserResourceCollection($users))
            ->get();
    }

    public function store(
        StoreUserRequest $request,
        StoreUserAction $storeUserAction
    ) {
        $role = $request->input("role");

        $userData = UserData::fromRequest($request);

        $user = $storeUserAction($userData, $role);

        $user->load("roles")
            ->loadCount("articles");

        return $this->responseFactory->setStatusCode(200)
            ->setMessage(__("Kullanıcı başarılı şekilde eklendi"))
            ->setData(new UserResource($user))
            ->get();
    }

    public function show(User $user)
    {
        $user->load("roles")
            ->loadCount("articles");

        return $this->responseFactory->setStatusCode(200)
            ->setData(new UserResource($user))
            ->get();
    }

    public function update(
        UpdateUserRequest $request,
        User $user,
        UpdateUserAction $updateUserAction
    ) {
        $role = $request->input("role");

        $userData = UserData::fromRequest($request);

        $user = $updateUserAction($userData, $user, $role);

        $user->load("roles")
            ->loadCount("articles");

        return $this->responseFactory->setStatusCode(200)
            ->setMessage("Kullanıcı bilgileri başarılı şekilde güncellendi.")
            ->setData(new UserResource($user))
            ->get();
    }

    public function destroy(
        User $user,
        DestroyUserAction $destroyUserAction
    ) {
        $destroyUserAction($user);

        return $this->responseFactory->setStatusCode(200)
            ->setMessage("Kullanıcı başarılı şekilde silindi.")
            ->get();
    }
}
