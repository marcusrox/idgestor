<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendedoresTable extends Migration
{

    public function up()
    {
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();

            $table->string('tipo_pessoa')->length(1);
            $table->string('nome');
            $table->string('cpf_cnpj');
            $table->string('razao_social')->nullable();
            $table->string('telefone')->nullable();
            $table->string('celular');
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->length(9)->nullable();
            $table->string('cidade')->nullable();
            $table->foreignId('uf_id')->constrained();

            $table->foreignId('user_id')->constrained();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });

        // Schema::table('vendedores', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')
        //         ->onDelete('restrict')
        //         ->onUpdate('restrict');
        // });
    }

    public function down()
    {
        Schema::drop('vendedores');
    }
}
