<?php

namespace App\Http\Resources\IRC;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NickCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => NickResource::collection($this->collection),
        ];
    }
}
