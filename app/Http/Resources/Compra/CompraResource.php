<?php

namespace App\Http\Resources\Compra;

use App\Http\Resources\ResourceBase;

class CompraResource extends ResourceBase
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
