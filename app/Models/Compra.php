<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $with = [
        'fornecedores',
    ];

    public function fornecedores()
    {
        return $this->hasMany('App\Models\Fornecedor', 'compra_id', 'id');
    }
}
