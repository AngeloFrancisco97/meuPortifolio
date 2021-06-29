<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersNovasTabelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('idade');
            $table->text('descricao_perfil');
            $table->string('foto_perfil', 100);
            $table->string('foto_descricao', 100);
            $table->string('celular', 20);
            $table->string('endereco', 200);
            $table->string('profissao', 100);
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
            $table->dropColumn('idade');
            $table->dropColumn('descricao_perfil');
            $table->dropColumn('foto_perfil');
            $table->dropColumn('foto_descricao');
            $table->dropColumn('celular');
            $table->dropColumn('endereco');
            $table->dropColumn('profissao');
        });
    }
}
