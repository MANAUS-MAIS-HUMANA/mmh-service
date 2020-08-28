<?php

namespace App\Http\Resources\Dashboard;

use App\Http\Resources\ResourceBase;

class DashboardResource extends ResourceBase
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
