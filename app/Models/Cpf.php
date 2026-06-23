<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpf extends Model
{
    protected $fillable = ['numero', 'pessoa_id'];

    // Um CPF pertence a uma pessoa
    public function person()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
