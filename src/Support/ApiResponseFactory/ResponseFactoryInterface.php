<?php


namespace Support\ApiResponseFactory;


interface ResponseFactoryInterface
{
    public function setStatusCode(int $statusCode = 200): self;

    public function setMessage(string $message = ""): self;

    public function setErrors(array $errors = []): self;

    public function setData($data): self;

    public function get($only_data = false);

    public function getErrorResponse(string $message, int $statusCode = 500);
}
