<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoRecurso extends Model
{
    use HasFactory;

    protected $table = 'solicitacao_recurso';
    protected $fillable = [
        'nome_solicitante',
        'nome_comunidade',
        'nome_lider',
        'cidade_proxima',
        'longitude',
        'latitude',
        'regiao',
        'descricao',
        'arquivos_imagens_evidencias',
        'descricao_recurso',
        'descricao_localizacao',
        'categoria_recurso_id'
    ];

    const STATUS = [
        'Aguardando' => 'Aguardando',
        'Em análise' => 'Em análise',
        'Aprovado' => 'Aprovado',
        'Reprovado' => 'Reprovado'
    ];

    protected $casts = [
        'arquivos_imagens_evidencias' => 'array'
    ];

    public function categoriaRecurso()
    {
        return $this->belongsTo(CategoriaRecurso::class);
    }

    public function imagemEvidenciaSolicitacao()
    {
        return $this->hasMany(ImagemEvidenciaSolicitacao::class, 'solicitacao_recurso_id', 'id');
    }
}
