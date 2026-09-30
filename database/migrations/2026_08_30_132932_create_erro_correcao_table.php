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
    Schema::create('erro_correcao', function (Blueprint $table) {
        $table->id('ERC_CODIGO');
        $table->unsignedBigInteger('ERC_COR_CODIGO')->nullable();
        $table->text('ERC_DESCRICAO')->nullable();
        $table->integer('ERC_DESCONTO')->nullable();
        $table->tinyInteger('ERC_CONTESTADO')->default(0);
        $table->tinyInteger('ERC_ACEITO')->default(0);

        $table->foreign('ERC_COR_CODIGO')->references('COR_CODIGO')->on('correcao')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('erro_correcao');
}
};
