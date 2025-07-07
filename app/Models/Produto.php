<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public function funcionario(){

        return $this->belongsTo(funcionario::class,'id_funcionario');
    }
    public function stock(){
        
        return $this->hasOne(Stock::class,'id_produto');
    }

}
