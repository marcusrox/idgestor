<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotesTable extends Migration
{

    public function up()
    {
        Schema::create('lotes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            //$table->integer('leilao_id')->unsigned();
            $table->foreignId('leilao_id')->constrained('leiloes');

            //$table->integer('vendedor_id')->unsigned();
            $table->foreignId('vendedor_id')->constrained('vendedores');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('lotes');
    }
}
