<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'cursos';
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
