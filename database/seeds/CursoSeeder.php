<?php

use App\Models\Curso;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cursos = collect([
            ['nome' => 'Administração'],
            ['nome' => 'Atendimento ao Cliente'],
            ['nome' => 'Custos'],
            ['nome' => 'Finanças'],
            ['nome' => 'Informática'],
            ['nome' => 'Não Tenho Interesse'],
            ['nome' => 'Outro'],
            ['nome' => 'Planejamento'],
            ['nome' => 'Plano de Negócio'],
            ['nome' => 'Preço de venda'],
            ['nome' => 'Saúde e Beleza'],
            ['nome' => 'Vendas'],
        ]);

        $cursos->each(fn($curso) => Curso::updateOrCreate($curso));
    }
}
