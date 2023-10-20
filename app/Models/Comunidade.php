<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidade extends Model
{
    use HasFactory;

    protected $table = 'comunidade';
    protected $fillable = [
        'nome',
        'nome_lider',
        'descricao',
        'arquivo_imagem',
        'descricao'
    ];

    const REGIOES = [
        'Norte' => 'Norte',
        'Nordeste' => 'Nordeste',
        'Centro-Oeste' => 'Centro-Oeste',
        'Sudeste' => 'Sudeste',
        'Sul' => 'Sul'
    ];

    public function getImagemUrlAttribute()
    {
        return $this->arquivo_imagem ? url("storage/{$this->arquivo_imagem}") : null;
    }
}
