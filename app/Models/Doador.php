<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doador extends Model
{
    protected $table = 'doadores';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nome',
        'total_cestas_basicas'
    ];
    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
    ];
}
