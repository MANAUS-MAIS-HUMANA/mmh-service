<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoPessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_pessoa', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_pessoa', array_keys(\App\Models\TipoPessoa::TIPO_PESSOA))->default('pf')->comment("pf - Pessoa Física;\npj - Pessoa Jurídica.");
            $table->string('cpf_cnpj', 14)->unique();
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
        Schema::dropIfExists('tipos_pessoa');
    }
}
