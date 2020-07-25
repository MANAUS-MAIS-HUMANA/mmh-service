<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    protected $table = 'estados_civis';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function beneficiarios()
    {
        return $this->hasMany('App\Models\Beneficiario');
    }
}
