<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_pessoa_id_foreign');
            $table->dropColumn('pessoa_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('nome')->after('id');
            $table->string('telefone')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nome');
            $table->dropColumn('telefone');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('pessoa_id')->after('id');
            $table->foreign('pessoa_id')->references('id')->on('pessoas');
        });
    }
}
