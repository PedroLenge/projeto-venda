<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class ProdutoController extends Controller
{
    public function index(){
        $valor = Produto::orderBy('nome','desc','funcionario')->get();
        return view('pages.admin.produto',compact('valor'));
    }

    public function store(Request $request){

        try{

                //DEFINIR REGRAS DE VALIDAÇÃO
                $rules = [
                'nome' => ['required', 'string', 'regex:/^[a-zA-ZÀ-ÿ\s]+$/'],
                'descricao' => ['required'],
                'categoria' => ['required', 'string', 'regex:/^[a-zA-ZÀ-ÿ\s]+$/']
            ];

            $request->validate($rules,[
                'nome.required'=>'O NOME É OBRIGATÓRIO',
                'nome.regex'=>'O NOME DEVE CONTER APENAS LETRAS!',
                'descricao.required'=>'A DESCRICAO É OBRIGATÓRIA!',
                'categoria.required'=>'A CETEGORIA É OBRIGATÓRIA!',
                'categoria.regex'=>'A CETEGORIA  DEVE CONTER APENAS LETRAS!'
            ]);

            //VERIFICAR SE JÁ EXISTE PRODUTO IGUAL
            $produtoDuplicado = Produto::where('nome', $request->nome)
            ->where('descricao',$request->descricao)
            ->where('categoria',$request->categoria);

            if($request->filled('id')) {
                $produtoDuplicado->where('id','!=',$request->id);
            }

            if($produtoDuplicado->exists()) {
                return redirect()->back()->withInput()->with("ERRO", "JÁ EXISTE UM PRODUTO COM O MESMO NOME, DESCRIÇÃO E CATEGORIA.");
            }
            $valor = $request->filled('id') ? Produto::find($request->id) : new Produto();

            //PREENCHER OS CAMPOS DO FORMULÁRIO
            
            $valor->nome = $request->nome;
            $valor->descricao = $request->nome;
            $valor->categoria= $request->nome;
            $valor->funcionario_id = Auth::guard('funcionario')->user()->id;
            $valor->save();
            return redirect()->back()->with("SUCESSO",$request->filled('id') ? "ACTUALIZADO COM SUCESSO" : "CADASTRADO COM SUCESSO");
        }catch(validectionException $e){

            return redirect()->back()->withErrors($e->validator)->withInput();
        
        } catch(QueryException){

            return redirect()->back()->with("ERRO","ERRO AO SALVAR PRODUTO,TENTE NOVAMENTE.");
        }

    }

    public function show($id){
        $valor = Produto::find($id)
        if(!$valor){
            ret
        }

    }

}
