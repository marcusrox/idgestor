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
        Schema::create('transportadoras', function (Blueprint $table) {
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

            $table->string('nome_contato')->nullable();
            $table->string('site')->nullable();

            $table->string('condicoes_transporte')->nullable();

            $table->boolean('ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportadoras');
    }
};
