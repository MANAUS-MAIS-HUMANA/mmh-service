<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexBeneficiaryName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiarios', function (Blueprint $table) {
            $table->index('nome');
            $table->index('cpf');
            $table->index('email');
            $table->index('ativo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiarios', function (Blueprint $table) {
            $table->dropIndex('beneficiarios_nome_index');
            $table->dropIndex('beneficiarios_cpf_index');
            $table->dropIndex('beneficiarios_email_index');
            $table->dropIndex('beneficiarios_ativo_index');
        });
    }
}
