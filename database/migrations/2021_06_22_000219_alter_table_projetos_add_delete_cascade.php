<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProjetosAddDeleteCascade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('imagens_projetos', function (Blueprint $table) {
        //     $table->dropColumn('projeto_id');
        // });
        Schema::table('imagens_projetos', function (Blueprint $table) {
            $table->unsignedBigInteger('projeto_id')->default(1)->after('id');
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('imagens_projetos', function (Blueprint $table) {
            $table->dropForeign('imagens_projetos_projeto_id_foreign');
            $table->dropColumn('projeto_id');
        });
        Schema::table('imagens_projetos', function (Blueprint $table) {
            $table->unsignedBigInteger('projeto_id');
            $table->foreign('projeto_id')->references('id')->on('projetos');
        });
    }
}
