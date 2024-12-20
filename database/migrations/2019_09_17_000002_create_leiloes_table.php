<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeiloesTable extends Migration
{

    public function up()
    {
        Schema::create('leiloes', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('nome_organizador');
            $table->longText('html_descricao');
            $table->string('local_leilao');
            $table->date('dt_leilao_de');
            $table->date('dt_leilao_ate');
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('leiloes');
    }
}
