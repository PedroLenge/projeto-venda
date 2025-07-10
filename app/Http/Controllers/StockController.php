<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Stock;

class StockController extends Controller
{
    public function index($id  = null){
        if($id){

            $valor = Produto::orderBy('nome','desc')->findOrFail($id);
            $stock = Stock::with('produto','funcionario')->where('id_produto', $id)->get();
        }else{

            $valor = null;
            $stock = Stock::with('produto','funcionario')->get();
        
        }
        return view('pasges.admin.stocks', compact('stock', 'valor'));  
    }
    
}
