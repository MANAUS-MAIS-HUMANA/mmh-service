<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBeneficiarioColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiarios', function (Blueprint $table) {
            $table->dropColumn('total_residentes');
        });
        Schema::table('beneficiarios', function (Blueprint $table) {
            $table->string('total_residentes')->nullable()->after('cpf_conjuge');
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
            $table->dropColumn('total_residentes');
        });
        Schema::table('beneficiarios', function (Blueprint $table) {
            $table->unsignedInteger('total_residentes')->nullable()->after('cpf_conjuge');
        });
    }
}
