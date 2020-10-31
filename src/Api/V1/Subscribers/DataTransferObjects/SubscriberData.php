<?php


namespace Api\V1\Subscribers\DataTransferObjects;


use Api\V1\Subscribers\Requests\DestroySubscriberRequest;
use Api\V1\Subscribers\Requests\StoreSubscriberRequest;
use Spatie\DataTransferObject\DataTransferObject;

class SubscriberData extends DataTransferObject
{
    public string $email;

    public ?string $name;


    public static function fromRequest(StoreSubscriberRequest $request): self
    {
        return new self([
            "email" => $request->input("email"),
            "name" => $request->input("name")
        ]);
    }
}
