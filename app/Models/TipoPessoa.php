<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoPessoa extends Model
{
    protected $table = 'tipos_pessoa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipo_pessoa', 'cpf_cnpj'
    ];
    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    const TIPO_PESSOA = [
        'pf' => 'PF',
        'pj' => 'PJ',
    ];
}
