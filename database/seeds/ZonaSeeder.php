<?php

use App\Models\Zona;
use Illuminate\Database\Seeder;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zonas = collect([
            ['cidade_id' => '1', 'nome' => 'Centro-Oeste'],
            ['cidade_id' => '1', 'nome' => 'Centro-Sul'],
            ['cidade_id' => '1', 'nome' => 'Leste'],
            ['cidade_id' => '1', 'nome' => 'Norte'],
            ['cidade_id' => '1', 'nome' => 'Oeste'],
            ['cidade_id' => '1', 'nome' => 'Sul'],
        ]);

        $zonas->each(fn($zona) => Zona::updateOrCreate($zona));
    }
}
