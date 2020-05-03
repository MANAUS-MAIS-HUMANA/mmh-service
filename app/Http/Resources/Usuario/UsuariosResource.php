<?php

namespace App\Http\Resources\Usuario;

use App\Http\Resources\ResourceBase;

class UsuariosResource extends ResourceBase
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
            return $this->resource->map(function ($usuario) {
                return [
                    'id' => $usuario->id,
                    'nome' => $usuario->pessoa->nome,
                    'email' => $usuario->email,
                    'status' => $usuario->statusParse,
                    'perfis' => $usuario->perfis()
                        ->get(['perfil'])
                        ->pluck('perfil')
                ];
            });
        }
    }
}
