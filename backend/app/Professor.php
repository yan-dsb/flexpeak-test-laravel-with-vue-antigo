<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    protected $fillable = ['nome', 'data_nascimento'];
    protected $table = 'professores';

    public function curso(){

        return $this->belongsTo('App\Curso', 'id', 'curso_id');
    }
    
}
