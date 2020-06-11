<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBeneficiarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_civis', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            $table->timestamps();
        });

        Schema::create('beneficiarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parceiro_id');
            $table->boolean('ativo')->default(true);
            $table->string('nome');
            $table->string('cpf');
            $table->string('email')->nullable();
            $table->date('data_nascimento');
            $table->string('trabalho')->nullable();
            $table->boolean('esta_desempregado')->nullable();
            $table->unsignedBigInteger('estado_civil_id')->nullable();
            $table->string('nome_conjuge')->nullable();
            $table->string('cpf_conjuge')->nullable();
            $table->unsignedInteger('total_residentes')->nullable();
            $table->string('situacao_moradia')->nullable();
            $table->decimal('renda_mensal')->default(0)->nullable();
            $table->boolean('gostaria_montar_negocio')->nullable();
            $table->boolean('gostaria_participar_cursos')->nullable();
            $table->string('tipo_curso')->nullable();
            $table->boolean('concorda_informacoes_verdadeiras');
            $table->dateTime('data_submissao')->nullable();

            $table->foreign('parceiro_id')->references('id')->on('parceiros');
            $table->foreign('estado_civil_id')->references('id')->on('estados_civis');

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
        Schema::dropIfExists('beneficiarios');
        Schema::dropIfExists('estados_civis');
    }
}
