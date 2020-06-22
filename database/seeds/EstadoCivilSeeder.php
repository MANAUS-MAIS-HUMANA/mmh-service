<?php

use App\Models\EstadoCivil;
use Illuminate\Database\Seeder;

class EstadoCivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estadosCivis = collect([
            ['nome' => 'Casado'],
            ['nome' => 'Divorciado'],
            ['nome' => 'Separado'],
            ['nome' => 'Solteiro'],
            ['nome' => 'União Estável'],
            ['nome' => 'Viúvo'],
        ]);

        $estadosCivis->each(fn($estadoCivil) => EstadoCivil::updateOrCreate($estadoCivil));
    }
}
