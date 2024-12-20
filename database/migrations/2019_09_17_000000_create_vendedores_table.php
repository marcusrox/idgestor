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
            //$table->enum('tipo_pessoa', ['F', 'J']);
            $table->string('tipo_pessoa', 1);
            $table->string('cpf_cnpj');
            $table->string('nome');
            $table->string('razao_social');
            $table->string('telefone');
            $table->foreignId('users_id')->constrained();
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
