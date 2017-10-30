<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMedicamentoVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicamento_venda', function (Blueprint $table) {
            $table->integer('medicamento_id');
            $table->foreign('medicamento_id')->references('id')->on('medicamentos');
            $table->integer('venda_id');
            $table->foreign('venda_id')->references('id')->on('vendas');
            $table->decimal('valor_unitario');
            $table->integer('quantidade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicamento_venda');
    }
}
