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
                'descricao' => 'Administrador do sistema',
            ],
            'Parceiro' => [
                'perfil' => 'parceiro',
                'descricao' => 'Igreja, Ong, Transportador e etc',
            ],
        ]);

        $perfis->each(fn($perfil) => Perfil::updateOrCreate($perfil));
    }
}
