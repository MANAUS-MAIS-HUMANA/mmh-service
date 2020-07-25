<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiarioDoacao extends Model
{
    protected $table = 'beneficiarios_doacoes';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'beneficiario_id',
        'parceiro_id',
        'created_at',
        'updated_at',
    ];

    public function parceiro()
    {
        return $this->hasOne('App\Models\Parceiro', 'id', 'parceiro_id');
    }

    public function beneficiario()
    {
        return $this->hasOne('App\Models\Beneficiario', 'id', 'beneficiario_id');
    }

}
