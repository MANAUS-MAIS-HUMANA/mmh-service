<?php

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hasUser = User::where('email', '=', 'mmh@gmail.com')->exists();
        if (!$hasUser) {
            /* Cria ou atualiza o usuário */
            $user = User::updateOrCreate([
                'pessoa_id' => 1,
                'email' => 'mmh@gmail.com',
                'senha' => Hash::make('admin123'),
                'status' => 'A',
            ]);

            /* Atualiza na tabela pivot 'users_perfis' o perfil do usuário */
            $user->perfis()->sync(Perfil::wherePerfil('admin')->get());
        }
    }
}
