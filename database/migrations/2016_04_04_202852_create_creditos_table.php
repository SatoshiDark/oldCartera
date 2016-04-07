<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Tipo Prestamo
        Schema::create('tipo_prestamo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->double('minimo');
            $table->double('maximo');
            $table->integer('tiempo_de_gracia')->unsigned();
            $table->integer('tiempo_maximo_pago')->unsigned();
            $table->double('interes');
            $table->double('comisiones');

            $table->timestamps();
        });

        // Create Tipo Cliente
//        todo review WTF is this
        Schema::create('tipo_cliente', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('plazo_vigente')->unsigned();
            $table->integer('plazo_vencido')->unsigned();
            $table->integer('plazo_castigado')->unsigned();
            $table->double('interes_penal');
            $table->timestamps();
        });

//1er paso, crear solicitud

        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cooperativa_id')->unsigned();
            $table->integer('tipo_credito_id')->unsigned();
            $table->string('nro_solicitud');
            $table->string('nombre_proyecto');
            $table->date('fecha_solicitud');
            $table->double('importe_solicitado');
            $table->double('importe_propio');
            $table->double('importe_total');
            $table->integer('socio_id')->unsigned();
//            UPDATE version 2: estado de solicitud, 0:pendiente, 1:rechazada, 2:aprobada
//            $table->boolean('aprobada');
            $table->unsignedSmallInteger('estado');
//            $table->date('fecha_aprobacion');
//            $table->double('monto_aprobado');
            $table->text('adjunto');
            $table->text('requisitos');

            $table->timestamps();
        });

        Schema::table('solicitudes', function($table) {
            $table->foreign('cooperativa_id')->references('id')->on('cooperativas');
        });

//        Aprobar solicitud
        Schema::create('solicitudes_resolucion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_id')->unsigned();
            $table->unsignedSmallInteger('estado');
            $table->date('fecha_resolucion');
            $table->double('monto_aprobado'); //note
            $table->text('adjunto');
//            $table->json('requisitos');

            $table->timestamps();
        });

        Schema::table('solicitudes_resolucion', function($table) {
            $table->foreign('solicitud_id')->references('id')->on('solicitudes');
        });

        // Generar Credito
        Schema::create('creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('solicitud_id')->unsigned();
            $table->integer('cooperativa_id')->unsigned();
            $table->string('codigo_prestamo');
            $table->unsignedSmallInteger('estado_prestamo'); // 0: en proceso, 1: completado, 2: otros
            $table->date('fecha_desembolso');
            $table->integer('fecha_pago');//todo review why
            $table->string('moneda');
            $table->double('plazo');
            $table->integer('tiempo_gracia');
            $table->double('importe_credito');
            $table->double('total_mes');
            $table->double('tasa');
            $table->double('interes');
            $table->double('cuota_capital');
            $table->double('saldo_capital');
            $table->integer('checksum');
            $table->double('suma_total_pagado');
            $table->date('ultima_amortizacion');
            $table->timestamps();
        });
        Schema::table('creditos', function($table) {
            $table->foreign('solicitud_id')->references('id')->on('solicitudes_resolucion');
        });

        // Generar Credito
        Schema::create('plan_creditos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('credito_id')->unsigned();
            $table->boolean('periodo_gracia'); // 0: nope, 1: sip
            $table->date('fecha_pago');

            $table->double('cuota_capital');
            $table->double('cuota_interes');
            $table->double('total_cuota');
            $table->double('saldo_capital');
            $table->text('nota_modificacion');

            $table->timestamps();
        });
        Schema::table('plan_creditos', function($table) {
            $table->foreign('credito_id')->references('id')->on('creditos');
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
        Schema::drop('tipo_prestamo');
        Schema::drop('tipo_cliente');
        Schema::drop('solicitudes');
        Schema::drop('solicitudes_resolucion');
        Schema::drop('creditos');
        Schema::drop('plan_creditos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
