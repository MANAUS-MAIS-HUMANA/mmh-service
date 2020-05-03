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
            return [
                'id' => $this->id,
                'nome' => $this->pessoa->nome,
                'email' => $this->email,
                'status' => $this->statusParse,
                'perfis' => $this->perfis()
                    ->get(['perfil'])
                    ->pluck('perfil')
            ];
        }
    }
}
