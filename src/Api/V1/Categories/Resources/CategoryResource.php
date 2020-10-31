<?php


namespace Api\V1\Categories\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return $this->resource;
    }
}
