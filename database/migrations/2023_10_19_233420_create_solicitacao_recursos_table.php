<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitacao_recurso', function (Blueprint $table) {
            $table->id();
            $table->string('nome_solicitante');
            $table->string('nome_comunidade');
            $table->string('nome_lider');
            $table->string('cidade_proxima');
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->enum('regiao', ['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul']);
            $table->text('descricao_localizacao')->nullable();
            $table->text('descricao_recurso')->nullable();
            $table->text('arquivos_imagens_evidencias')->nullable();
            $table->enum('status', ['Aguardando', 'Em análise', 'Aprovado', 'Reprovado']);
            $table->foreignId('categoria_recurso_id')->constrained('categoria_recurso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacao_recurso');
    }
};
