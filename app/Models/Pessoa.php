<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'pessoas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome', 'endereco', 'estado', 'tipo_pessoa_id'
    ];

    public function tipoPessoa()
    {
        return $this->hasOne(TipoPessoa::class, 'id', 'tipo_pessoa_id');
    }
}
