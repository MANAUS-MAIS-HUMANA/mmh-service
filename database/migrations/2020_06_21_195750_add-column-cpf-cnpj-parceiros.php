<?php

use App\Models\TipoPessoa;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCpfCnpjParceiros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parceiros', function (Blueprint $table) {
            $table->dropForeign('parceiros_tipo_pessoa_id_foreign');
            $table->dropColumn('tipo_pessoa_id');

            $table->enum('tipo_pessoa', array_keys(TipoPessoa::TIPO_PESSOA))
                ->default('pj')
                ->comment("pf - Pessoa Física;\npj - Pessoa Jurídica.")
                ->after('email');
            $table->string('cpf_cnpj', 14)->after('tipo_pessoa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parceiros', function (Blueprint $table) {
            $table->dropColumn('cpf_cnpj');
            $table->dropColumn('tipo_pessoa');
            $table->unsignedBigInteger('tipo_pessoa_id');
            $table->foreign('tipo_pessoa_id')->references('id')->on('tipos_pessoa');
        });
    }
}
