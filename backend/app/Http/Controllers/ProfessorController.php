<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Professor;
use App\Http\Resources\Professor as ProfessorResource;
use App\Http\Resources\ProfessorCollection;


class ProfessorController extends Controller
{
    public function index(){
        return new ProfessorCollection(Professor::all());
    }

    public function show($id){
        return new ProfessorResource(Professor::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'data_nascimento'=>'required'
        ]);

        $professor = Professor::create($request->all());

        return (new ProfessorResource($professor))
                ->response()
                ->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);
        $request->validate([
            'nome' => 'required|max:255',
            'data_nascimento'=>'required'
        ]);    
        $professor->update($request->all());

        return (new ProfessorResource($professor))
                ->response()
                ->setStatusCode(201);

    }

    public function delete($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();

        return response()->json(null, 204);
    }
}
