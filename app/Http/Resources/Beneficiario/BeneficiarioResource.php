<?php

namespace App\Http\Resources\Beneficiario;

use App\Http\Resources\ResourceBase;

class BeneficiarioResource extends ResourceBase
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
