<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'is_admin' => true
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Apinaje',
            'email' => 'apinaje@gmail.com',
            'is_admin' => false
        ]);


        $itensCategoria = [
            [
                'nome' => 'Alimentação',
            ],
            [
                'nome' => 'Livro',
            ],
            [
                'nome' => 'Material Escola',
            ],
            [
                'nome' => 'Material de Construção',
            ],
            [
                'nome' => 'Moradia',
            ],
            [
                'nome' => 'Outros'
            ]
        ];

        \App\Models\CategoriaRecurso::factory()->createMany($itensCategoria);
        \App\Models\SolicitacaoRecurso::factory()->count(30)->create();
    }
}
