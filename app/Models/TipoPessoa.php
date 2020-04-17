<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPessoa extends Model
{
    protected $table = 'tipo_pessoas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo', 'cpf_cnpj'
    ];
}
