<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = [
        'nome',
        'data_nascimento',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    public function cpf()
    {
        return $this->hasOne(Cpf::class);
    }
}
