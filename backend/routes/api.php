<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/professores', 'ProfessorController@index');
Route::get('/professores/{id}', 'ProfessorController@show');
Route::post('/professores', 'ProfessorController@store');
Route::put('/professores/{id}', 'ProfessorController@update');
Route::delete('/professores/{id}', 'ProfessorController@delete');
Route::get('/cursos', 'CursoController@index');
Route::get('/cursos/{id}', 'CursoController@show');
Route::post('/cursos', 'CursoController@store');
Route::put('/cursos/{id}', 'CursoController@update');
Route::delete('/cursos/{id}', 'CursoController@delete');
Route::get('/alunos', 'AlunoController@index');
Route::get('/alunos/{id}', 'AlunoController@show');
Route::post('/alunos', 'AlunoController@store');
Route::put('/alunos/{id}', 'AlunoController@update');
Route::delete('/alunos/{id}', 'AlunoController@delete');