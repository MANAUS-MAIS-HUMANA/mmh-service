<?php

use App\Models\TipoPessoa;
use Illuminate\Database\Seeder;

class TipoPessoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoPessoa::updateOrCreate([
            'tipo' => 'pj',
            'cpf_cnpj' => '0'
        ]);
    }
}
