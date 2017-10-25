<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCooperativasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('cooperativas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('personeria_juridica');
            $table->string('codigo');
            $table->string('nro_registro')->unique();
            $table->string('derecho_consesionario');
            $table->string('federacion_afiliada');
            $table->string('ci_representante_legal');
            $table->string('nombre_representante_legal');
            $table->integer('cantidad_socios');
            $table->date('fecha_formacion');
            $table->date('fecha_resolucion');
            $table->string('direccion');
            $table->integer('departamento_id')->unsigned();
            $table->integer('provincia_id')->unsigned();
            $table->integer('municipio_id')->unsigned();
            $table->integer('localidad_id')->unsigned();
            $table->string('telefono');
            $table->string('fax');
            $table->string('casilla_postal');
            $table->string('email');
            $table->string('web');
            $table->string('coordinadas_utm');
            $table->string('produccion_anual');
            $table->integer('mineral_id')->unsigned();

            $table->decimal('latitude',20,10);
            $table->decimal('longitude',20,10);
            $table->timestamps();
        });


        Schema::create('socios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cooperativa_id')->unsigned();
            $table->string('nombre_completo');
            $table->string('ci')->unique();
            $table->date('fecha_nacimiento');
            $table->date('fecha_sociedad');
            $table->string('domicilio');
            $table->integer('departamento_id')->unsigned();
            $table->integer('provincia_id')->unsigned();

            $table->string('telefono');
            $table->string('email');
            $table->string('fax');
            $table->string('web');

            $table->string('condicion_de_relacion');
            $table->string('certificado_aporte');
            $table->string('fecha_certificacion');
            $table->string('nombre_referencia');
            $table->string('domicilio_referencia');
            $table->string('telefono_referencia');

            $table->timestamps();
        });

        // add foreign keys
        Schema::table('cooperativas', function($table) {
        });

        Schema::table('socios', function($table) {
            $table->foreign('cooperativa_id')->references('id')->on('cooperativas');
        });


//        supervision de Cooperativas
        Schema::create('supervision_cooperativas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cooperativa_id')->unsigned();
//            $table->string('nombre');
            $table->date('fecha');
            $table->double('produccion');
            $table->string('unidad_produccion');
            $table->text('observaciones');

            $table->timestamps();
        });
        Schema::table('supervision_cooperativas', function($table) {
            $table->foreign('cooperativa_id')->references('id')->on('cooperativas');
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
        Schema::drop('socios');
        Schema::drop('cooperativas');
        Schema::drop('supervision_cooperativas');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
