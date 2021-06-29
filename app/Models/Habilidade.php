<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilidade extends Model
{
    use HasFactory;
    protected $fillable = ['titulo', 'imagem', 'descricao', 'cursos'];

    public function rules() {
        return [
            'titulo' => 'required',
            'imagem' => 'required|file|mimes:png',
            'descricao' => 'required',
        ];
    }
}

