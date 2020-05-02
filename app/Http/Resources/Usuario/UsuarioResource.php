<?php

namespace App\Http\Resources\Usuario;

use App\Http\Resources\ResourceBase;

class UsuarioResource extends ResourceBase
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->resource) {
            return $this->resource->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nome' => $item->pessoa->nome,
                    'email' => $item->email,
                    'perfis' => $item->perfis()
                        ->get(['perfil'])
                        ->pluck('perfil')
                ];
            });
        }
    }
}
