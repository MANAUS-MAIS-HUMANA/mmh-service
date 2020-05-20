<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];

    public function cidades()
    {
        return $this->hasMany('App\Models\Cidade');
    }
}
