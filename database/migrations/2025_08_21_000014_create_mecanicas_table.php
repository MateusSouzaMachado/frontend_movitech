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
        Schema::create('mecanicas', function (Blueprint $table) {
            $table->id();
            $table->string('cnpj')->unique();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('endereco');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->string('senha');
            $table->boolean('aprovado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mecanicas');
    }
};
