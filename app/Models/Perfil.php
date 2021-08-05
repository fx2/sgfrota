<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $fillable = [
        'setor_id',
        'nome',
        'descricao',
        'status',
    ];

    public function setor()
    {
        return $this->hasOne('App\Models\Setor', 'id', 'setor_id');
    }
}
