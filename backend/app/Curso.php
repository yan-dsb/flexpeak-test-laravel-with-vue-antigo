<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Curso extends Model
{
    protected $fillable = ['nome'];
    protected $table = 'cursos';
    protected $with = 'professor';

    public function professor()
    {
        return $this->hasOne('App\Professor', 'id', 'professor_id');
    }
    public function aluno()
    {
        return $this->belongsTo('App\Aluno', 'id', 'aluno_id');
    }
}
