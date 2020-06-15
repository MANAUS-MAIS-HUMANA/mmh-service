<?php

namespace App\Http\Resources\Doador;

use App\Http\Resources\ResourceBase;

class DoadorResource extends ResourceBase
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
