<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeDonationDateNotNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiarios_doacoes', function (Blueprint $table) {
            $table->dropColumn('data_doacao');
        });
        Schema::table('beneficiarios_doacoes', function (Blueprint $table) {
            $table->timestamp('data_doacao')->nullable()->after('total_cestas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beneficiarios_doacoes', function (Blueprint $table) {
            $table->dropColumn('data_doacao');
        });
        Schema::table('beneficiarios_doacoes', function (Blueprint $table) {
            $table->timestamp('data_doacao')->nullable(false)->after('total_cestas');
        });
    }
}
