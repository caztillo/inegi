<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('indicadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('indicador',255)->unique();
            $table->string('nombre',255);
            $table->timestamps();
        });

        Schema::create('ubicaciones_geograficas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',255)->unique();
            $table->string('nombre',255);
            $table->timestamps();
        });

        Schema::create('indicadores_ubicaciones_geograficas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('indicador_id')
                ->unsigned();
            $table->foreign("indicador_id", 'fk_indicadores')
                ->references("id")
                ->on("indicadores")->onDelete('cascade');
            $table->integer('ubicacion_geografica_id')
                ->unsigned();
            $table->foreign("ubicacion_geografica_id", 'fk_ubicaciones_geograficas')
                ->references("id")
                ->on("ubicaciones_geograficas")->onDelete('cascade');
            $table->integer("periodo");
            $table->decimal("valor", 10,2);
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
        //
        Schema::table('indicadores_ubicaciones_geograficas', function ( $table)
        {
            $table->dropForeign('fk_indicadores');
            $table->dropForeign('fk_ubicaciones_geograficas');
        });

        Schema::table('indicadores_ubicaciones_geograficas', function ( $table)
        {
            $table->dropUnique('indicadores_ubicaciones_geograficas_codigo_unique');
        });

        Schema::table('indicadores', function ( $table)
        {
            $table->dropUnique('indicadores_indicador_unique');
        });

        Schema::drop('indicadores_ubicaciones_geograficas');
        Schema::drop('ubicaciones_geograficas');
        Schema::drop('indicadores');
    }
}
