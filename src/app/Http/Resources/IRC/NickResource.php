<?php

namespace App\Http\Resources\IRC;

use Illuminate\Http\Resources\Json\JsonResource;

class NickResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->getId()->value(),
            'name' => $this->getName()->value(),
            'password' => $this->getPassword()->value(),
            'isActive' => $this->getIsActive()->value(),
            'lastUse' => $this->getLastUse()->value()
        ];
    }
}