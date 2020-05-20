<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $table = 'cidades';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    protected $hidden = [
        'id',
        'estado_id',
        'created_at',
        'updated_at',
    ];
    protected $with = [
        'estado',
    ];

    public function estado()
    {
        return $this->hasOne('App\Models\Estado', 'id', 'estado_id');
    }

    public function bairros()
    {
        return $this->hasMany('App\Models\Bairro');
    }
}
