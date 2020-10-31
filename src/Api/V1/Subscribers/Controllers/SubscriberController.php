<?php


namespace Api\V1\Subscribers\Controllers;


use Api\V1\Subscribers\Actions\DestroySubscriberAction;
use Api\V1\Subscribers\Actions\StoreSubscriberAction;
use Api\V1\Subscribers\DataTransferObjects\SubscriberData;
use Api\V1\Subscribers\Models\Subscriber;
use Api\V1\Subscribers\Requests\StoreSubscriberRequest;
use Api\V1\Subscribers\Resources\SubscriberResource;
use Api\V1\Subscribers\Resources\SubscriberResourceCollection;
use App\Http\Controllers\Controller;
use Support\ApiResponseFactory\ResponseFactoryInterface;

class SubscriberController extends Controller
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
        $subscribers = Subscriber::query()
            ->paginate(20);

        return $this->responseFactory->setStatusCode(200)
            ->setData(new SubscriberResourceCollection($subscribers))
            ->get();
    }

    public function store(
        StoreSubscriberRequest $request,
        StoreSubscriberAction $storeSubscriberAction
    ) {
        $subscriberData = SubscriberData::fromRequest($request);

        $subscriber = $storeSubscriberAction($subscriberData);

        return $this->responseFactory->setStatusCode(200)
            ->setMessage("İşlem başarılı.")
            ->setData(new SubscriberResource($subscriber))
            ->get();
    }

    public function show(Subscriber $subscriber)
    {
        return $this->responseFactory->setStatusCode(200)
            ->setData(new SubscriberResource($subscriber))
            ->get();
    }

    public function destroy(
        Subscriber $subscriber,
        DestroySubscriberAction $destroySubscriberAction
    ) {
        $destroySubscriberAction($subscriber);

        return $this->responseFactory->setStatusCode(200)
            ->setMessage("Abone kaydı başarılı şekilde silindi.")
            ->get();
    }
}
