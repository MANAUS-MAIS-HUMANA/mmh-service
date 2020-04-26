<?php

use App\Models\Cidade;
use Illuminate\Database\Seeder;

class CidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cidades = collect([
            [
                'estado_id' => '1',
                'nome' => 'Manaus',
            ],
        ]);

        $cidades->each(fn($cidade) => Cidade::updateOrCreate($cidade));
    }
}
