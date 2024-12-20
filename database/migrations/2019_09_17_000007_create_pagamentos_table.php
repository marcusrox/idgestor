<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{

    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            //$table->integer('parcela_id')->unsigned();
            $table->foreignId('parcela_id')->constrained('parcelas');

            $table->decimal('vl_pagamento', 8, 2);
            $table->datetime('dt_pagamento');

            $table->string('paypal_nonce')->nullable();
            $table->string('paypal_transaction_id')->nullable();
            $table->json('paypal_transaction_json')->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('pagamentos');
    }
}
