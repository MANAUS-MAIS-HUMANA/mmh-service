<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $table = 'perfis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'perfil', 'descricao'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_perfis', 'perfil_id', 'user_id');
    }
}
