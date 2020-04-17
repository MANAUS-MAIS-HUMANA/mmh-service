<?php

use App\Models\Perfil;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfis = collect([
            'Admin' => [
                'perfil' => 'admin',
                'descricao' => 'Master',
            ],
            'Codese' => [
                'perfil' => 'codese',
                'descricao' => 'Administrador',
            ],
            'Parceiro' => [
                'perfil' => 'parceiro',
                'descricao' => 'Igreja, Ong, Transportador e etc',
            ],
            'Doador' => [
                'perfil' => 'doador',
                'descricao' => 'Beneficiador',
            ],
            'Beneficiario' => [
                'perfil' => 'beneficiario',
                'descricao' => 'Beneficiado',
            ],
        ]);

        $perfis->each(fn($perfil) => Perfil::updateOrCreate($perfil));
    }
}
