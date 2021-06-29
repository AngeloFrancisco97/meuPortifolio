<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projeto extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'capa_projeto', 'descricao', 'descricao_completa', 'ferramentas', 'repositorio'];

    public function rules() {
        return [
            'nome' => 'required',
            'capa_projeto' => 'required|file|mimes:png',
            'descricao' => 'required',
            'descricao_completa' => 'required',
            'ferramentas' => 'required',
            'repositorio' => 'required',
        ];
    }
    public function imagensProjeto() {
        return $this->hasMany('App\Models\ImagensProjeto');
    }
}
