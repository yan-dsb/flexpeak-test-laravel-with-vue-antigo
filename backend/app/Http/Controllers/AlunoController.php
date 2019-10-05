<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Http\Resources\Aluno as AlunoResource;
use App\Http\Resources\AlunoCollection;

class AlunoController extends Controller
{
    public function index(){
        return new AlunoCollection(Aluno::all());
    }
    public function show($id){
        return new AlunoResource(Aluno::findOrFail($id));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
        ]); 
        
        $aluno = new Aluno();
        $aluno->nome = $request->nome;
        $aluno->data_nascimento = $request->data_nascimento;
        $aluno->logradouro = $request->logradouro;
        $aluno->numero = $request->numero;
        $aluno->bairro = $request->bairro;
        $aluno->cidade = $request->cidade;
        $aluno->estado = $request->estado;
        $aluno->cep = $request->cep;
        $aluno->curso_id = $request->curso;

        $aluno->save();

        return (new AlunoResource($aluno))
                ->response()
                ->setStatusCode(201);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nome' => 'required|max:255',
        ]); 
        
        $aluno = Aluno::findOrFail($id);
        $aluno->nome = $request->nome;
        $aluno->data_nascimento = $request->data_nascimento;
        $aluno->logradouro = $request->logradouro;
        $aluno->numero = $request->numero;
        $aluno->bairro = $request->bairro;
        $aluno->cidade = $request->cidade;
        $aluno->estado = $request->estado;
        $aluno->cep = $request->cep;
        $aluno->curso_id = $request->curso;
        $aluno->update();
        return (new AlunoResource($aluno))
                ->response()
                ->setStatusCode(201);
    }
    public function delete($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();

        return response()->json(null, 204);
    }
}
