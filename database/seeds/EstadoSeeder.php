<?php

use App\Models\Estado;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = collect([
            [
                'uf' => 'AM',
                'nome' => 'Amazonas',
            ],
        ]);

        $estados->each(fn($estado) => Estado::updateOrCreate($estado));
    }
}
