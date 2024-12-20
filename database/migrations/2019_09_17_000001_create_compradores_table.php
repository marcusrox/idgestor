<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompradoresTable extends Migration
{

    public function up()
    {
        Schema::create('compradores', function (Blueprint $table) {
            $table->id();
            //$table->enum('tipo_pessoa', ['F', 'J']);
            $table->string('tipo_pessoa', 1);
            $table->string('cpf_cnpj');
            $table->string('nome');
            $table->string('razao_social');
            $table->string('telefone');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('compradores');
    }
}
