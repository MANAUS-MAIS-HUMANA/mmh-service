<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    protected $table = 'beneficiarios';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'estado_civil_id',
    ];

    public function estadoCivil()
    {
        return $this->hasOne('App\Models\EstadoCivil', 'id', 'estado_civil_id');
    }

    public function parceiro()
    {
        return $this->hasOne('App\Models\Parceiro', 'id', 'parceiro_id');
    }

    public function curso()
    {
        return $this->hasOne('App\Models\Curso', 'id', 'curso_id');
    }

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone', 'beneficiario_id', 'id');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Models\Endereco', 'beneficiario_id', 'id');
    }
}
