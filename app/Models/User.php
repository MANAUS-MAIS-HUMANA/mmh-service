<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'senha', 'pessoa_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha'
    ];

    public function pessoa()
    {
        return $this->hasOne(Pessoa::class, 'id', 'pessoa_id');
    }

    public function perfis()
    {
        return $this->belongsToMany(Perfil::class, 'users_perfis', 'user_id', 'perfil_id');
    }
}
