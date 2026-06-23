<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = ['nome', 'data_nascimento'];

    // Uma pessoa tem um CPF
    public function cpf()
    {
        return $this->hasOne(Cpf::class);
    }
}