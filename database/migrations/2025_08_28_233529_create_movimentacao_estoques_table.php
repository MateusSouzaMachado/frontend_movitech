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
         Schema::create('movimentacao_estoque', function (Blueprint $table) {
                $table->id();
                $table->foreignId('estoque_id')->constrained('estoques')->onDelete('cascade');
                $table->foreignId('responsavel_id')->nullable()->constrained('administradores');
                $table->enum('tipo', ['entrada', 'saida_venda', 'ajuste_manual']);
                $table->integer('quantidade'); 
                $table->string('motivo')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimentacao_estoques');
    }
};
