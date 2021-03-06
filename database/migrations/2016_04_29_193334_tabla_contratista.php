<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaContratista extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Contratistas', function($table)
        {
            $table->increments('Id_Contratista');
            $table->string('Nombre', 120);
            $table->string('Cedula')->unique();
            $table->string('Numero_Cta');
            $table->boolean('Activo')->default(1);
            $table->boolean('Hijos')->default(1);
            $table->boolean('Declarante')->default(1);
            $table->boolean('Medicina_Prepagada')->default(1);
            $table->tinyInteger('Hijos_Cantidad')->unsigned();
            $table->integer('Medicina_Prepagada_Cantidad')->unsigned();
            $table->enum('Tipo_Cuenta', ['CC', 'CA']);
            $table->enum('Nivel_Riesgo_ARL', ['1', '2', '3', '4', '5']);
            $table->integer('Id_TipoDocumento')->unsigned();
            $table->integer('Id_Banco')->unsigned();
            $table->foreign('Id_Banco')->references('Id_Banco')->on('Bancos')->onDelete('cascade');
            
            $table->softDeletes();
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
        Schema::table('Contratistas', function(Blueprint $table){
            $table->dropForeign(['Id_Banco']);
        });

        Schema::drop('Contratistas');
    }
}
