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
    Schema::create('correcao', function (Blueprint $table) {
        $table->id('COR_CODIGO');
        $table->unsignedBigInteger('COR_RED_CODIGO')->nullable();
        $table->integer('COR_NOTA')->nullable();
        $table->text('COR_TEXTO')->nullable();
        $table->boolean('COR_FOLHA')->default(0);

        $table->foreign('COR_RED_CODIGO')->references('RED_CODIGO')->on('redacao')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('correcao');
}
};
