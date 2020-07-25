<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doacao extends Model
{
    protected $table = 'doacoes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'quantidade',
        'total_cestas_basicas',
        'data_doacao',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function doador()
    {
        return $this->belongsTo('App\Models\Doador', 'doador_id');
    }
}
