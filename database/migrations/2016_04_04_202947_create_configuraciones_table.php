<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // tabla de capital
//        todo Ajustar segun necesidades
        Schema::create('capital', function (Blueprint $table) {
            $table->increments('id');
            $table->date('gestion');
            $table->double('capital');
            $table->double('saldo_anterior');
            $table->integer('prestamos_acumulados')->unsigned();
            $table->text('descripcion');
            $table->string('adjunto');

            $table->timestamps();
        });

        Schema::create('mineral_produccion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('tipo');

            $table->timestamps();
        });

//        todo verificar si se utiliza
        Schema::create('mora', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valor_maximo');
            $table->string('valor_minimo');
            $table->double('factor');

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
        Schema::drop('capital');
        Schema::drop('mineral_produccion');
        Schema::drop('mora');
    }
}
