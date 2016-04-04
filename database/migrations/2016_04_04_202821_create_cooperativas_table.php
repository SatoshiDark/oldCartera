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
            $table->string('codigo');
            $table->string('nro_registro')->unique();
            $table->string('derecho_consesionario');
            $table->string('federacion_afiliada');
            $table->string('ci_representante_legal');
            $table->integer('cantidad_socios');
            $table->date('fecha_formacion');
            $table->date('fecha_resolucion');
            $table->string('direccion');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('municipio_id')->references('id')->on('municipios');
            $table->foreign('localidad_id')->references('id')->on('localidades');
            $table->string('telefono');
            $table->string('fax');
            $table->string('casilla_postal');
            $table->string('email');
            $table->string('web');
            $table->foreign('mineral_id')->references('id')->on('minerales');

            $table->decimal('latitude',20,10);
            $table->decimal('longitude',20,10);
            $table->timestamps();
        });

        Schema::create('socios', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('cooperativa_id')->references('id')->on('cooperativas');
            $table->string('nombre_completo');
            $table->string('ci')->unique();
            $table->date('fecha_nacimiento');
            $table->date('fecha_sociedad');
            $table->string('domicilio');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('provincia_id')->references('id')->on('provincias');

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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('cooperativas');
        Schema::drop('socios');

    }
}
