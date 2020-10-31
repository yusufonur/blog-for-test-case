<?php


namespace Api\V1\Subscribers\Actions;


use Api\V1\Subscribers\DataTransferObjects\SubscriberData;
use Api\V1\Subscribers\Models\Subscriber;

class StoreSubscriberAction
{
    public function __invoke(SubscriberData $subscriberData): Subscriber
    {
        return Subscriber::firstOrCreate(
            ["email" => $subscriberData->email],
            ["name" => $subscriberData->name]
        );
    }
}
