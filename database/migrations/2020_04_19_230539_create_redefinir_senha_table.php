<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedefinirSenhaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('redefinir_senha', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('email');
            $table->string('token')->index();
            $table->dateTime('validade');
            $table->enum('status', array_keys(\App\Models\RedefinirSenha::TIPO_STATUS))->default('A')->comment("A - Ativo;\nI - Inativo.");
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
        Schema::dropIfExists('redefinir_senha');
    }
}
