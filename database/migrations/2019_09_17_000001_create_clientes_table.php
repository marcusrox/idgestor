<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{

    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();

            $table->string('tipo_pessoa')->length(1);
            $table->string('nome');
            $table->string('cpf_cnpj');
            $table->string('razao_social')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular');
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->length(9)->nullable();
            $table->string('cidade')->nullable();
            $table->string('uf')->length(2)->nullable();

            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('clientes');
    }
}
