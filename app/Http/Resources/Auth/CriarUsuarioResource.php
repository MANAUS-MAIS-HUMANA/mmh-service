<?php

namespace App\Http\Resources\Auth;

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
                'nome' => $this->nome,
                'email' => $this->email,
                'telefone' => $this->telefone,
                'perfis' => $this->perfis()
                    ->get(['perfil'])
                    ->pluck('perfil')
            ];
        }
    }
}
