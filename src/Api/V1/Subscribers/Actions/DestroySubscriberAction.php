<?php


namespace Api\V1\Subscribers\Actions;


use Api\V1\Subscribers\DataTransferObjects\SubscriberData;
use Api\V1\Subscribers\Models\Subscriber;

class DestroySubscriberAction
{
    public function __invoke(Subscriber $subscriber)
    {
        return $subscriber->delete();
    }
}
