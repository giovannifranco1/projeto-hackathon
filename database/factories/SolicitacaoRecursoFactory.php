<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SolicitacaoRecurso>
 */
class SolicitacaoRecursoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'categoria_recurso_id' => $this->faker->numberBetween(1, 4),
            'nome_solicitante' => $this->faker->name,
            'nome_comunidade' => $this->faker->name,
            'nome_lider' => $this->faker->name,
            'cidade_proxima' => $this->faker->city,
            'longitude' => $this->faker->longitude,
            'latitude' => $this->faker->latitude,
            'seeded' => true,
            'regiao' => $this->faker->randomElement(['Norte', 'Nordeste', 'Centro-Oeste', 'Sudeste', 'Sul']),
            'descricao_localizacao' => $this->faker->text,
            'descricao_recurso' => $this->faker->text,
            'status' => $this->faker->randomElement(['Aguardando', 'Em análise', 'Aprovado', 'Reprovado']),
        ];
    }
}
