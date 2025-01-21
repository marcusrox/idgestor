<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendedor_id')->constrained('vendedores');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->foreignId('venda_situacao_id')->constrained('vendas_situacoes');
            $table->string('observacao')->nullable();
            $table->string('numero_pedido')->nullable();
            $table->enum('tipo_frete', ['FOB', 'CIF']);
            $table->enum('natureza_operacao', ['VENDA', 'BONIF']);
            $table->foreignId('forma_pagamento_id')->constrained('formas_pagamento');
            $table->bigInteger('pct_comissao');
            $table->bigInteger('pct_vpc');
            $table->foreignId('transportadora_id')->nullable()->constrained('transportadoras');
            $table->date('dt_base_faturamento');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
