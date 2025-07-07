<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;


class FuncionarioController extends Controller
{
    public function index(){
         $funcionario = Funcionario::orderBy('nome','asc')->get();
         return view('pages.admin.funcionario', compact('funcionario'));
    }

    public function store(Request $request){

        try {
            //Regras de validação

            $rules = [
                'nome'=>['required','string','min:10','max:255','regex:/^[a-zA-ZÀ-ÿ\s]+$/'],
                'email'=>'required|email|unique:funcionarios,email',
                'telefone'=>'required|digits:9|unique:funcionarios,telefone'

            ];

            //Ajuste regras para edição 
            if($request->filled('id')){
                $funcionarioExistente = Funcionario::find($request->id);
                if(!$funcionarioExistente){
                    return redirect()->back()->with("ERRO","FUNCIONARIO NÃO ENCONTRADO");
                }
            }


        } catch (QueryException $e) {
            //
        }


    }
}
