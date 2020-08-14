<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enderecos', function (Blueprint $table) {
            $table->dropColumn('numero');
            $table->dropColumn('complemento');
            $table->dropColumn('ponto_referencia');
            $table->dropColumn('cep');
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
            $table->string('numero')->after('endereco');
            $table->string('complemento')->after('numero')->nullable();
            $table->string('ponto_referencia')->nullable()->after('zona_id');
            $table->string('cep')->after('ponto_referencia');
        });
    }
}
