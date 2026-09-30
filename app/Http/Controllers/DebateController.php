<?php

namespace App\Http\Controllers;

use App\Models\Debate;
use App\Models\Redacao;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class DebateController extends Controller
{
    public function __construct(private GeminiService $gemini) {}

    public function show(Redacao $redacao)
    {
        if ($redacao->RED_DEBATE_ENCERRADO) {
            return back()->with('erro', 'O debate desta redação foi encerrado.');
        }
        return view('debate.show', compact('redacao'));
    }

    public function store(Request $request, Redacao $redacao)
    {
        $argumento = trim($request->input('argumento', ''));
        if (!$argumento) {
            return back()->withErrors(['argumento' => 'Argumento inválido.']);
        }

        Debate::create([
            'DEB_RED_CODIGO' => $redacao->RED_CODIGO,
            'DEB_AUTOR' => 'ALUNO',
            'DEB_MENSAGEM' => $argumento,
        ]);

        $correcao = $redacao->correcao;
        $historico = Debate::where('DEB_RED_CODIGO', $redacao->RED_CODIGO)
            ->orderBy('DEB_CODIGO')
            ->get()
            ->map(fn($d) => "{$d->DEB_AUTOR}: {$d->DEB_MENSAGEM}")
            ->implode("\n\n");

        $prompt = "Você é um corretor do ENEM. Analise a correção original e o argumento do aluno...\n\n" .
            "NOTA ORIGINAL:\n{$correcao->COR_NOTA}\n\nCORREÇÃO ORIGINAL:\n{$correcao->COR_TEXTO}\n\n" .
            "ARGUMENTO ATUAL:\n$argumento\n\nHISTÓRICO DO DEBATE:\n$historico";

        $resultado = $this->gemini->perguntar($prompt);
        $textoDebate = $resultado['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!$textoDebate) {
            return back()->with('erro', 'Resposta inesperada da IA.');
        }

        Debate::create([
            'DEB_RED_CODIGO' => $redacao->RED_CODIGO,
            'DEB_AUTOR' => 'IA',
            'DEB_MENSAGEM' => $textoDebate,
        ]);

        preg_match('/DECISÃO:\s*(ACEITO|REJEITADO|ENCERRADO)/i', $textoDebate, $match);
        if (strtoupper($match[1] ?? '') === 'ENCERRADO') {
            $redacao->update(['RED_DEBATE_ENCERRADO' => 1]);
        }

        return view('debate.resultado', ['debate' => $textoDebate]);
    }
}