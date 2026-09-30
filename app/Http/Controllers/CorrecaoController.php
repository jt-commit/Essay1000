<?php

namespace App\Http\Controllers;

use App\Models\Correcao;
use App\Models\Redacao;
use App\Services\GeminiService;

class CorrecaoController extends Controller
{
    public function __construct(private GeminiService $gemini) {}

    public function show(Redacao $redacao)
    {
        $correcaoExistente = $redacao->correcao;

        if ($correcaoExistente) {
            return view('correcao.show', ['correcao' => $correcaoExistente]);
        }

        $prompt = "Corrija esta redação do ENEM. Retorne exatamente neste formato:\n\n" .
            "NOTA: valor entre 0 e 1000\n\nERROS:\n\nSUGESTÕES:\n\nPONTOS FORTES:\n\n" .
            "Tema:\n{$redacao->RED_TEMA}\n\n" .
            "Introdução:\n{$redacao->RED_INTRODUCAO}\n\n" .
            "Desenvolvimento:\n{$redacao->RED_DESENVOLVIMENTO}\n\n" .
            "Conclusão:\n{$redacao->RED_CONCLUSAO}";

        $resultado = $this->gemini->perguntar($prompt);

        if (isset($resultado['error'])) {
            return back()->with('erro', 'IA sobrecarregada, tente novamente em alguns minutos.');
        }

        $texto = $resultado['candidates'][0]['content']['parts'][0]['text'];
        preg_match('/NOTA(?:_FINAL)?\s*:\s*(\d+)/i', $texto, $matches);
        $nota = isset($matches[1]) ? (int) $matches[1] : 0;

        $correcao = Correcao::create([
            'COR_RED_CODIGO' => $redacao->RED_CODIGO,
            'COR_NOTA' => $nota,
            'COR_TEXTO' => $texto,
        ]);

        return view('correcao.show', compact('correcao'));
    }
}