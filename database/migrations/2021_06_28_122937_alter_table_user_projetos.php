<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUserProjetos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('curriculo', 100);
        });
        Schema::table('projetos', function (Blueprint $table) {
            $table->dropColumn('repositorio');
        });
        Schema::table('projetos', function (Blueprint $table) {
            $table->string('repositorio', 200)->after('ferramentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projetos', function (Blueprint $table) {
            $table->dropColumn('repositorio');
        });
        Schema::table('projetos', function (Blueprint $table) {
            $table->string('repositorio', 200)->after('ferramentas');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('curriculo');
        });
    }
}
