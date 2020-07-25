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
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function cidades()
    {
        return $this->hasMany('App\Models\Cidade');
    }
}
