<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
   
   public function produto(){
    
    return $this->belongsTo(produto::class,'produto_id');

   }

    public function funcionario(){

    return $this->belongsTo(funcionario::class,'funcionario_id');

   }

}
