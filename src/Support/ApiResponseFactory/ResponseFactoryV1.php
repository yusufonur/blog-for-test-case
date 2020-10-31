<?php


namespace Support\ApiResponseFactory;


use Illuminate\Http\Resources\Json\JsonResource;

class ResponseFactory implements ResponseFactoryInterface
{
    private int $statusCode = 200;

    private string $message = "";

    private array $errors = [];

    private array $data = [];


    /**
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode = 200): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     * @return $this
     */
    public function setMessage(string $message = ""): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param array $errors
     * @return $this
     */
    public function setErrors(array $errors = []): self
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * DİKKAT: Gelen parametre array veya JsonResource tipinde değilse hata dönmez.
     * @param $data
     * @return $this|null
     */
    public function setData($data): self
    {
        if ($data instanceof JsonResource) {
            $this->data = $data->resource->toArray();
        }

        if (is_array($data)) {
            $this->data = $data;
        }

        return $this;
    }

    public function get($only_data = false)
    {
        $data = [
            "message" => $this->message,
            "errors" => $this->errors,
        ];

        if ($this->data) {
            $data["data"] = $this->data;
        }


        if ($only_data) {
            return $data;
        }

        return response()->json($data, $this->statusCode);
    }

    public function getErrorResponse(string $message, int $statusCode = 500)
    {
        if (!$this->errors) {
            $this->errors = (array)$message;
        }

        return $this->setMessage($message)
            ->setStatusCode($statusCode)
            ->get();
    }

}
