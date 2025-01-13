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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('codigo', 255);
            $table->string('descricao', 255)->nullable();

            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('fornecedor_id')->constrained('fornecedores');

            $table->string('ncm')->nullable();
            $table->string('cfop', 20)->nullable();
            $table->string('cst', 20)->nullable();
            $table->string('unidade', 20)->nullable();
            $table->decimal('peso_bruto', 10, 3)->nullable();
            $table->decimal('peso_liquido', 10, 3)->nullable();
            $table->decimal('largura', 10, 2)->nullable();
            $table->decimal('altura', 10, 2)->nullable();
            $table->decimal('profundidade', 10, 2)->nullable();
            $table->integer('estoque_minimo')->nullable();
            $table->integer('estoque_atual')->nullable();
            $table->integer('estoque_maximo')->nullable();
            $table->decimal('preco_custo', 10, 2)->nullable();
            $table->decimal('preco_venda', 10, 2);
            $table->decimal('pct_mc', 5, 2)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
