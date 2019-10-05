<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Curso;
use App\Http\Resources\Curso as CursoResource;

class Aluno extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'nome'=> $this->nome,
            'data_nascimento'=> $this->data_nascimento,
            'logradouro'=> $this->logradouro,
            'numero'=> $this->numero,
            'bairro'=> $this->bairro,
            'cidade'=> $this->cidade,
            'estado'=> $this->estado,
            'cep'=> $this->cep,
            'curso'=> new CursoResource($this->curso),
            'created_at'=> $this->created_at,
            'updated_at'=> $this->updated_at, 
        ];
    }
}
