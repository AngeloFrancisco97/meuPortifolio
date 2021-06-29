<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informacao extends Model
{
    use HasFactory;
    protected $table = 'informacoes';
    protected $fillable = ['user_id', 'tipo', 'descricao'];

    public function rules() {
        return [
            'user_id' => 'required|exists:users,id',
            'tipo' => 'required',
            'descricao' => 'required',
        ];
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
