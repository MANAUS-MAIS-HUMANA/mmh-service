<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('uf', 2);
            $table->string('nome');

            $table->timestamps();
        });

        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estado_id');
            $table->string('nome');

            $table->foreign('estado_id')->references('id')->on('estados');

            $table->timestamps();
        });

        Schema::create('bairros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cidade_id');
            $table->string('nome');

            $table->foreign('cidade_id')->references('id')->on('cidades');

            $table->timestamps();
        });

        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('endereco');
            $table->unsignedBigInteger('bairro_id')->nullable();
            $table->string('ponto_referencia')->nullable();
            $table->string('cep');
            $table->unsignedBigInteger('cidade_id');
            $table->unsignedBigInteger('parceiro_id')->nullable();

            $table->foreign('bairro_id')->references('id')->on('bairros');
            $table->foreign('cidade_id')->references('id')->on('cidades');
            $table->foreign('parceiro_id')->references('id')->on('parceiros');

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
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('bairros');
        Schema::dropIfExists('cidades');
        Schema::dropIfExists('estados');
    }
}
