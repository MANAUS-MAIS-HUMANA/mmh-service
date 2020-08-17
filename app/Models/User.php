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
        'nome', 'email', 'senha', 'status', 'telefone'
    ];
    protected $guarded = [
        'id'
    ];
    protected $hidden = [
        'pessoa_id', 'senha', 'created_at', 'updated_at'
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
                'nome' => $this->nome,
                'email' => $this->email,
                'status' => $this->statusParse,
                'perfis' => implode(',', array_column($this->perfis->toArray(), 'perfil')),
                'criado' => $this->created_at->format('d/m/Y'),
            ]
        ];
    }

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'users_perfis', 'user_id', 'perfil_id');
    }

    public function getStatusParseAttribute()
    {
        return self::STATUS_USUARIO[$this->status];
    }
}
