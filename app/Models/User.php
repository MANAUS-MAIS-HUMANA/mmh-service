<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'pessoa_id', 'email', 'senha', 'status'
    ];
    protected $hidden = [
        'senha'
    ];

    const STATUS_USUARIO = [
        'A' => 'Ativo',
        'I' => 'Inativo',
        'B' => 'Bloqueado',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                'nome' => $this->pessoa->nome,
                'email' => $this->email,
                'status' => self::STATUS_USUARIO[$this->status],
                'criado' => $this->created_at->format('d/m/Y'),
            ]
        ];
    }

    public function pessoa()
    {
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'users_perfis', 'user_id', 'perfil_id');
    }
}
