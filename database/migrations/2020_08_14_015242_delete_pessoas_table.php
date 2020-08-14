<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeletePessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('pessoas');
        Schema::dropIfExists('tipos_pessoa');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tipos_pessoa', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_pessoa', array_keys(\App\Models\TipoPessoa::TIPO_PESSOA))->default('pf')->comment("pf - Pessoa Física;\npj - Pessoa Jurídica.");
            $table->string('cpf_cnpj', 14)->unique();
            $table->timestamps();
        });

        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_pessoa_id');
            $table->string('nome');
            $table->string('endereco');
            $table->string('estado', 2);
            $table->timestamps();

            $table->foreign('tipo_pessoa_id')->references('id')->on('tipos_pessoa');
        });
    }
}
