<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosTable extends Migration
{

    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //$table->integer('parcela_id')->unsigned();
            $table->foreignId('parcela_id')->constrained('parcelas');

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('boletos');
    }
}
