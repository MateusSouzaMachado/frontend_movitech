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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mecanica_id')->constrained('mecanicas')->onDelete('cascade');
            $table->string('status')->default('pendente');
            $table->decimal('valor_total', 10, 2)->default(0);
            $table->string('endereco_entrega');
            $table->string('metodo_pagamento');
            $table->string('numero_nota_fiscal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
