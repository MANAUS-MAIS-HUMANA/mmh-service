<?php

namespace App\Http\Resources;

class RedefinirSenhaResource extends ResourceBase
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource) {
            return [
                'email' => $this->email,
                'nome' => $this->usuario->pessoa->nome,
                'token' => $this->token,
                'validade' => $this->validade,
            ];
        }
    }
}
