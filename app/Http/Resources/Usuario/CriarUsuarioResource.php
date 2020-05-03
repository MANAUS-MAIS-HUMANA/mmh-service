<?php

namespace App\Http\Resources\Usuario;

use App\Http\Resources\ResourceBase;

class CriarUsuarioResource extends ResourceBase
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
                'id' => $this->id,
                'nome' => $this->pessoa->nome,
                'email' => $this->email,
                'perfis' => $this->perfis()
                    ->get(['perfil'])
                    ->pluck('perfil')
            ];
        }
    }
}