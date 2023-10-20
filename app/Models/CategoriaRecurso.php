<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaRecurso extends Model
{
    use HasFactory;

    protected $table = 'categoria_recurso';
    protected $fillable = [
        'nome',
        'is_evidencia_required',
        'descricao'
    ];
}
