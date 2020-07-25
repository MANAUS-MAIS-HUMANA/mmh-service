<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RedefinirSenha extends Model
{
    protected $table = 'redefinir_senha';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id', 'email', 'token', 'validade', 'status'
    ];
    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'user_id', 'created_at', 'updated_at'
    ];

    const TIPO_STATUS = [
        'A' => 'Ativo',
        'I' => 'Inativo',
    ];

    public function usuario()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
