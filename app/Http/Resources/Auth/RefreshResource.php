<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\ResourceBase;

class RefreshResource extends ResourceBase
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
