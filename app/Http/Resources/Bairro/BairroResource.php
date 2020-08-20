<?php

namespace App\Http\Resources\Bairro;

use App\Http\Resources\ResourceBase;

class BairroResource extends ResourceBase
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource;
    }
}
