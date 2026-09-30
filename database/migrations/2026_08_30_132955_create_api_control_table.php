<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_control', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('indice_atual');
        });

        DB::table('api_control')->insert([
            'id' => 1,
            'indice_atual' => 0,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('api_control');
    }
};