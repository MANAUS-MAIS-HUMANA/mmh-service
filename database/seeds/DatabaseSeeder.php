<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             PerfilSeeder::class,
             UserSeeder::class,
             EstadoSeeder::class,
             CidadeSeeder::class,
             BairroSeeder::class,
             EstadoCivilSeeder::class,
             ZonaSeeder::class,
             CursoSeeder::class,
         ]);
    }
}
