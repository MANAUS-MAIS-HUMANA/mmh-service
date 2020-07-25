<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoPessoaToPessoasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_pessoa_id')->after('id');
            $table->foreign('tipo_pessoa_id')->references('id')->on('tipos_pessoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->dropForeign('pessoas_tipo_pessoa_id_foreign');
            $table->dropColumn('tipo_pessoa_id');
        });
    }
}
