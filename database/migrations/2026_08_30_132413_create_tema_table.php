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
    Schema::create('tema', function (Blueprint $table) {
        $table->id('TEM_CODIGO');
        $table->string('TEM_NOME', 50);
        $table->boolean('TEM_ATIVO')->default(true);
    });
}

public function down(): void
{
    Schema::dropIfExists('tema');
    }
};