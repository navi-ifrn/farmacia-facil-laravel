<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamentos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->text('bula');
            $table->decimal('valor_compra');
            $table->decimal('porcentagem_lucro');
            $table->integer('tipo');
            $table->integer('estoque');
            $table->integer('laboratorio_id');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorios');
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
        Schema::dropIfExists('medicamentos');
    }
}
