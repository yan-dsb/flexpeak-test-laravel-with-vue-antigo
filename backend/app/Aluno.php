<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome','data_nascimento','logradouro', 'numero', 'bairro', 'cidade', 'estado', 'cep'];
    protected $table = 'alunos';
    public function curso()
    {
        return $this->hasOne('App\Curso', 'id', 'curso_id');
    }
}
