<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'telefones';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];

    const TIPO_TELEFONE_CELULAR = 1;
    const TIPO_TELEFONE_FIXO = 2;
    const TIPO_TELEFONES = [
        'Celular' => self::TIPO_TELEFONE_CELULAR,
        'Fixo' => self::TIPO_TELEFONE_FIXO,
    ];

    public function parceiro()
    {
        return $this->belongsTo('App\Models\Parceiro', 'parceiro_id');
    }
}
