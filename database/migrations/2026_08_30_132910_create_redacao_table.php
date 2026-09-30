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
    Schema::create('redacao', function (Blueprint $table) {
        $table->id('RED_CODIGO');
        $table->string('RED_TEMA', 255);
        $table->text('RED_INTRODUCAO');
        $table->text('RED_DESENVOLVIMENTO');
        $table->text('RED_CONCLUSAO');
        $table->unsignedBigInteger('RED_USU_CODIGO')->nullable();
        $table->tinyInteger('RED_DEBATE_ENCERRADO')->default(0);

        $table->foreign('RED_USU_CODIGO')->references('USU_CODIGO')->on('usuario');
    });
}

public function down(): void
{
    Schema::dropIfExists('redacao');
 }
};