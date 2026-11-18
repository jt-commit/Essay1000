<?php

namespace Database\Seeders;

use App\Models\Tema;
use Illuminate\Database\Seeder;

class TemaSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['tema_padrao', 'tema_beta', 'tema_noturno'] as $nome) {
            Tema::firstOrCreate(
                ['TEM_NOME' => $nome],
                ['TEM_ATIVO' => true],
            );
        }
    }
}
