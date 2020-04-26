<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];

    public function cidade()
    {
        return $this->hasOne('App\Models\Cidade', 'id', 'cidade_id');
    }

    public function parceiro()
    {
        return $this->belongsTo('App\Models\Parceiro', 'parceiro_id');
    }

    public function bairro()
    {
        return $this->hasOne('App\Models\Bairro', 'id', 'bairro_id');
    }
}
