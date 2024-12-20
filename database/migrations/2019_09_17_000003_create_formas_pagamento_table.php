<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormasPagamentoTable extends Migration
{

    public function up()
    {
        Schema::create('formas_pagamento', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome');
            $table->decimal('pct_desconto', 8, 2);
            $table->integer('qtd_parcelas');
            $table->string('forma_parcelamento');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('formas_pagamento');
    }
}
