<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelasTable extends Migration
{

    public function up()
    {
        Schema::create('parcelas', function (Blueprint $table) {
            $table->id();
            //$table->integer('arremate_id')->unsigned();
            $table->foreignId('arremate_id')->constrained('arremates');

            $table->integer('nu_parcela')->unsigned();
            $table->date('dt_vencimento');
            $table->decimal('vl_parcela', 8, 2);
            $table->decimal('vl_desconto', 8, 2);
            $table->decimal('vl_pago', 8, 2)->default(0);
            //$table->enum('st_parcela', ['AB', 'LQ', 'PP', 'LB', 'RN']);
            $table->string('st_parcela', 2);
            $table->date('dt_liquidacao')->nullable();

            // ['AB' => 'Em aberto', 'LQ' => 'Liquidada', 'PP' => 'Paga Parcialmente', 'LB' => 'Liberada', 'RN' => 'Renegociada'];

            $table->timestamps();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('parcelas');
    }
}
