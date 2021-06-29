<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagensProjeto extends Model
{
    use HasFactory;
    protected $fillable = ['projeto_id', 'titulo', 'descricao', 'imagens_projeto'];

    public function rules() {
        return [
            'projeto_id' => 'required|exists:projetos,id',
            'titulo' => 'required',
            'descricao' => 'required',
            'imagens_projeto' => 'required|file|mimes:png',
        ];
    }

    public function projeto() {
        return $this->belongsTo('App\Models\Projeto');
    }
}
