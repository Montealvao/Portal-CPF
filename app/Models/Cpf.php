<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cpf extends Model
{
    protected $fillable = [
        'numero',
        'pessoa_id',
    ];

    public function pessoa()
    {
        return $this->belongsTo(Pessoa::class);
    }
}
