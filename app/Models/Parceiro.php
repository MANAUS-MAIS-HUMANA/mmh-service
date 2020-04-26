<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parceiro extends Model
{
    protected $table = 'parceiros';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];

    public function tipoPessoa()
    {
        return $this->hasOne('App\Models\TipoPessoa', 'id', 'tipo_pessoa_id');
    }

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone', 'parceiro_id', 'id');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Models\Endereco', 'parceiro_id', 'id');
    }
}
