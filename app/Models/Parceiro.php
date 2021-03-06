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
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $with = [
        'telefones',
        'enderecos',
    ];

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone', 'parceiro_id', 'id');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Models\Endereco', 'parceiro_id', 'id');
    }
}
