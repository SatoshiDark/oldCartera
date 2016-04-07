<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');

            $table->timestamps();
        });

        Schema::create('provincias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departamento_id')->unsigned();
            $table->string('nombre');

            $table->timestamps();
        });
        Schema::table('provincias', function($table) {
            $table->foreign('departamento_id')->references('id')->on('departamentos');
        });

        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provincia_id')->unsigned();
            $table->string('nombre');

            $table->timestamps();
        });
        Schema::table('municipios', function($table) {
            $table->foreign('provincia_id')->references('id')->on('provincias');
        });

        Schema::create('localidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('municipio_id')->unsigned();
            $table->string('nombre');

            $table->timestamps();
        });
        Schema::table('localidades', function($table) {
            $table->foreign('municipio_id')->references('id')->on('municipios');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('departamentos');
        Schema::drop('provincias');
        Schema::drop('municipios');
        Schema::drop('localidades');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
