<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Http\Resources\Curso as CursoResource;
use App\Http\Resources\CursoCollection;

use App\Professor;
use App\Http\Resources\Professor as ProfessorResource;
use App\Http\Resources\ProfessorCollection;

use Illuminate\Support\Facades\Log;

class CursoController extends Controller
{
    public function index(){
        return new CursoCollection(Curso::all());
    }
    public function show($id){
        return new CursoResource(Curso::findOrFail($id));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
        ]); 
        
        $curso = new Curso();
        $curso->nome = $request->nome;
        // $professor = Professor::findOrFail($request->professor);
        // $curso->professor($professor);
        $curso->professor_id = $request->professor;

        $curso->save();

        return (new CursoResource($curso))
                ->response()
                ->setStatusCode(201);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nome' => 'required|max:255',
        ]); 
        
        $curso = Curso::findOrFail($id);
        $curso->nome = $request->nome;
        $curso->professor_id = $request->professor;
        $curso->update();
        return (new CursoResource($curso))
                ->response()
                ->setStatusCode(201);
    }
    public function delete($id)
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return response()->json(null, 204);
    }

}
