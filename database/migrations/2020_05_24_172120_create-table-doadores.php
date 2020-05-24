<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDoadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doadores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('logo_url')->nullable();
            $table->string('cnpj', 14)->unique()->nullable();
            $table->string('cpf', 11)->unique()->nullable();

            $table->timestamps();
        });

        Schema::create('doacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doador_id');
            $table->string('valor_doado')->nullable();
            $table->integer('total_cestas_basicas')->default(0);
            $table->dateTime('data_doacao')->nullable();

            $table->foreign('doador_id')->references('id')->on('doadores');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('doacoes');
      Schema::dropIfExists('doadores');
    }
}
