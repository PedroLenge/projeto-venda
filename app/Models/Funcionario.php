<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'funcao',
        'telefone',
        'endereco',
        'data_contrato',
        'n_bilhete',
        'senha'
    ];
    
}
