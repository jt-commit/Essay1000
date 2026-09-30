<?php

namespace App\Services;

use App\Models\ApiControl;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function perguntar(string $prompt): array
    {
        $apiKeys = config('services.gemini.keys');

        $apiKey = DB::transaction(function () use ($apiKeys) {
            $control = ApiControl::lockForUpdate()->find(1);
            $indice = $control->indice_atual;
            $chave = $apiKeys[$indice];

            $control->indice_atual = ($indice + 1) % count($apiKeys);
            $control->save();

            return $chave;
        });

        $response = Http::post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
            ['contents' => [['parts' => [['text' => $prompt]]]]]
        );

        return $response->json();
    }
}
