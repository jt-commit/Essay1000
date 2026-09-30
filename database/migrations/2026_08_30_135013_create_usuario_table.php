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
    Schema::create('usuario', function (Blueprint $table) {
        $table->id('USU_CODIGO');
        $table->string('USU_NOME', 150)->nullable();
        $table->string('USU_SENHA', 255);
        $table->string('USU_EMAIL', 150)->unique();
        $table->integer('USU_FONTE')->default(16);
        $table->unsignedBigInteger('USU_TEM_CODIGO')->nullable();

        $table->foreign('USU_TEM_CODIGO')->references('TEM_CODIGO')->on('tema');
    });
}

public function down(): void
{
    Schema::dropIfExists('usuario');
}
};
