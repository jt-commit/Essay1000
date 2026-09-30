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
    Schema::create('debate', function (Blueprint $table) {
        $table->id('DEB_CODIGO');
        $table->unsignedBigInteger('DEB_RED_CODIGO')->nullable();
        $table->string('DEB_AUTOR', 20)->nullable();
        $table->text('DEB_MENSAGEM')->nullable();
        $table->string('DEB_RESULTADO', 20)->nullable();
        $table->timestamp('DEB_DATA')->useCurrent();

        $table->foreign('DEB_RED_CODIGO')->references('RED_CODIGO')->on('redacao')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('debate');
}
};
