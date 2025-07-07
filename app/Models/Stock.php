<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    public function funcionario(){

        return $this->belongsTo(funcionario::class,'id_funcionario');

    }

    public function produto(){

        return$this->belongsTo(produto::class,'id_produto');

    }
}
