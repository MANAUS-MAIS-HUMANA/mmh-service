<?php

use App\Models\Pessoa;
use Illuminate\Database\Seeder;

class PessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pessoa::updateOrCreate([
            'nome' => 'Manaus Mais Humana',
            'endereco' => '0',
            'estado' => 'AM',
            'tipo_pessoa_id' => 1,
        ]);
    }
}
