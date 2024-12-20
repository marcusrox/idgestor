<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArrematesTable extends Migration
{

    public function up()
    {
        Schema::create('arremates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->integer('comprador_id')->unsigned();
            $table->foreignId('comprador_id')->constrained('compradores');

            //$table->integer('lote_id')->unsigned();
            $table->foreignId('lote_id')->constrained('lotes');

            //$table->integer('forma_pagamento_id')->unsigned();
            $table->foreignId('forma_pagamento_id')->constrained('formas_pagamento');

            $table->decimal('vl_parcela', 8, 2);
            $table->date('dt_primeiro_pagamento');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('arremates');
    }
}
