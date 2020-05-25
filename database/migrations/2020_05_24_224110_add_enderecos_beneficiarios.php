<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnderecosBeneficiarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zonas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cidade_id');
            $table->string('nome');

            $table->foreign('cidade_id')->references('id')->on('cidades');

            $table->timestamps();
        });

        Schema::table('enderecos', function (Blueprint $table) {
            $table->string('numero')->after('endereco');
            $table->string('complemento')->after('numero')->nullable();
            $table->unsignedBigInteger('zona_id')->nullable()->after('bairro_id');
            $table->unsignedBigInteger('beneficiario_id')->nullable()->after('parceiro_id');

            $table->foreign('zona_id')->references('id')->on('zonas');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropForeign('enderecos_zona_id_foreign');
            $table->dropForeign('enderecos_beneficiario_id_foreign');
            $table->dropColumn('zona_id');
            $table->dropColumn('beneficiario_id');
            $table->dropColumn('complemento');
            $table->dropColumn('numero');
        });

        Schema::dropIfExists('zonas');
    }
}
