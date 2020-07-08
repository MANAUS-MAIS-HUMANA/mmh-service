<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBeneficiariosDoacoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiarios_doacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beneficiario_id');
            $table->unsignedBigInteger('parceiro_id');
            $table->integer('total_cestas');
            $table->timestamp('data_doacao');

            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios');
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
        Schema::dropIfExists('beneficiarios_doacoes');
    }
}
