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
                
                $rules['email'] = 'required|email|unique:funcionarios,email,'. $request->id;
                $rules['telefone'] = 'required|digits:9|unique:funcionarios,telefone,'.$request->id;
            }

            //validação 
            $request->validate($rules);

            //Criar ou editar funcionário
            $valor = $request->filled('id')
                ? Funcionario::find($request->id)
                : new Funcionario();
                
                $valor->nome = $request->nome;
                $valor->telefone = $request->telefone;
                $valor->endereco = $request->endereco;
                $valor->email = $request->email;
                $valor->data_contrato = $request->nome;
                $valor->n_bilhete = $request->n_bilhete;
                $valor->funcao = $request->funcao;
                $valor->senha = Hash::make($request->senha);
                $valor->save();

                return redirect()->back()->with("SUCESSO",$request->filled('id') ? "FUNCIONARIO ACTUALIZADO COM SUCESSO" : "FUNCIONARIO CADASTRADO COM SUCESSO");


        } catch (QueryException $e) {
            return redirect()->back()->with("ERRO","FUNCIONARIO NÃO ENCONTRADO!");
        }
    }

    public function show($id){

        $funcionario = Funcionario::find($id);
        if(!$funcionario){
            return redirect()->back()->with("ERRO", "FUNCIONARIO NÃO ENCONTRADO.");
        }
        return view('pages.admin.funcionario',compact('funcionario'));

    }

    public function destroy($id){

        $funcionario = Funcionario::find($id);
        if(!$funcionario){
            return redirect()->back()->with("ERRO","FUNCIONÁRIO NÃO ENCONTRADO");
        }
        $funcionario->delete();
        return redirect()->back()->with("SUCESSO","FUNCIONÁRIO EXCLUÍDO COM SUCESSO");
        
    }
    
}
