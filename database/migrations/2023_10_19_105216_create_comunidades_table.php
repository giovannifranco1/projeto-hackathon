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
        Schema::create('comunidade', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('nome_lider');
            $table->enum('regiao', ['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul']);
            $table->text('descricao')->nullable();
            $table->string('arquivo_imagem', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comunidade');
    }
};
