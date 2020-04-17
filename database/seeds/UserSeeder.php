<?php

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Cria ou atualiza o usuário */
        $user = User::updateOrCreate([
            'email' => 'admin@mmh.org',
            'senha' => bcrypt('admin'),
            'pessoa_id' => 1,
        ]);

        /* Atualiza na tabela pivot 'users_perfis' o perfil do usuário */
        $user->perfis()->sync(Perfil::wherePerfil('admin')->get());
    }
}
