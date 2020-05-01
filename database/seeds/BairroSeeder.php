<?php

use Illuminate\Database\Seeder;
use App\Models\Bairro;

class BairroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bairros = collect([
            ['cidade_id' => 1, 'nome' => 'Adrianópolis'],
            ['cidade_id' => 1, 'nome' => 'Aleixo'],
            ['cidade_id' => 1, 'nome' => 'Alfredo Nascimento'],
            ['cidade_id' => 1, 'nome' => 'Alvorada'],
            ['cidade_id' => 1, 'nome' => 'Aparecida'],
            ['cidade_id' => 1, 'nome' => 'Armando Mendes'],
            ['cidade_id' => 1, 'nome' => 'Betânia'],
            ['cidade_id' => 1, 'nome' => 'Cachoeirinha'],
            ['cidade_id' => 1, 'nome' => 'Centro'],
            ['cidade_id' => 1, 'nome' => 'Chapada'],
            ['cidade_id' => 1, 'nome' => 'Cidade de Deus'],
            ['cidade_id' => 1, 'nome' => 'Cidade Nova'],
            ['cidade_id' => 1, 'nome' => 'Colônia Antônio Aleixo'],
            ['cidade_id' => 1, 'nome' => 'Colônia Oliveira Machado'],
            ['cidade_id' => 1, 'nome' => 'Colônia Santo Antônio'],
            ['cidade_id' => 1, 'nome' => 'Colônia Terra Nova'],
            ['cidade_id' => 1, 'nome' => 'Compensa'],
            ['cidade_id' => 1, 'nome' => 'Coroado'],
            ['cidade_id' => 1, 'nome' => 'Crespo'],
            ['cidade_id' => 1, 'nome' => 'Da Paz'],
            ['cidade_id' => 1, 'nome' => 'Distrito Industrial I	'],
            ['cidade_id' => 1, 'nome' => 'Distrito Industrial II'],
            ['cidade_id' => 1, 'nome' => 'Dom Pedro'],
            ['cidade_id' => 1, 'nome' => 'Educandos'],
            ['cidade_id' => 1, 'nome' => 'Flores'],
            ['cidade_id' => 1, 'nome' => 'Gilberto Mestrinho'],
            ['cidade_id' => 1, 'nome' => 'Glória'],
            ['cidade_id' => 1, 'nome' => 'Japiim'],
            ['cidade_id' => 1, 'nome' => 'Jorge Teixeira'],
            ['cidade_id' => 1, 'nome' => 'Lago Azul'],
            ['cidade_id' => 1, 'nome' => 'Lírio do Vale'],
            ['cidade_id' => 1, 'nome' => 'Mauazinho'],
            ['cidade_id' => 1, 'nome' => 'Monte das Oliveiras'],
            ['cidade_id' => 1, 'nome' => 'Morro da Liberdade'],
            ['cidade_id' => 1, 'nome' => 'Nossa Senhora Aparecida'],
            ['cidade_id' => 1, 'nome' => 'Nossa Senhora das Graças'],
            ['cidade_id' => 1, 'nome' => 'Nova Cidade'],
            ['cidade_id' => 1, 'nome' => 'Nova Esperança'],
            ['cidade_id' => 1, 'nome' => 'Novo Aleixo'],
            ['cidade_id' => 1, 'nome' => 'Novo Israel'],
            ['cidade_id' => 1, 'nome' => 'Parque 10 de Novembro'],
            ['cidade_id' => 1, 'nome' => 'Parque das Laranjeiras'],
            ['cidade_id' => 1, 'nome' => 'Parque das Nações'],
            ['cidade_id' => 1, 'nome' => 'Petrópolis'],
            ['cidade_id' => 1, 'nome' => 'Planalto'],
            ['cidade_id' => 1, 'nome' => 'Ponta Negra'],
            ['cidade_id' => 1, 'nome' => 'Praça 14 de Janeiro'],
            ['cidade_id' => 1, 'nome' => 'Presidente Vargas'],
            ['cidade_id' => 1, 'nome' => 'Puraquequara'],
            ['cidade_id' => 1, 'nome' => 'Raiz'],
            ['cidade_id' => 1, 'nome' => 'Redenção'],
            ['cidade_id' => 1, 'nome' => 'Santa Etelvina'],
            ['cidade_id' => 1, 'nome' => 'Santa Luzia'],
            ['cidade_id' => 1, 'nome' => 'Santo Agostinho'],
            ['cidade_id' => 1, 'nome' => 'Santo Antônio'],
            ['cidade_id' => 1, 'nome' => 'São Francisco'],
            ['cidade_id' => 1, 'nome' => 'São Geraldo'],
            ['cidade_id' => 1, 'nome' => 'São Jorge'],
            ['cidade_id' => 1, 'nome' => 'São José Operário'],
            ['cidade_id' => 1, 'nome' => 'São Lázaro'],
            ['cidade_id' => 1, 'nome' => 'São Raimundo'],
            ['cidade_id' => 1, 'nome' => 'Tancredo Neves'],
            ['cidade_id' => 1, 'nome' => 'Tarumã'],
            ['cidade_id' => 1, 'nome' => 'Tarumã-Açu'],
            ['cidade_id' => 1, 'nome' => 'Vila Buriti'],
            ['cidade_id' => 1, 'nome' => 'Vila da Prata'],
            ['cidade_id' => 1, 'nome' => 'Zumbi dos Palmares'],
        ]);

        $bairros->each(fn($bairro) => Bairro::updateOrCreate($bairro));
    }
}