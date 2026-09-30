<?php

namespace App\Http\Controllers;

use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedacaoController extends Controller
{
    public function index()
    {
        $redacoes = Redacao::with('correcao')
            ->where('RED_USU_CODIGO', Auth::id())
            ->get();

        return view('redacoes.index', compact('redacoes'));
    }

    public function create()
    {
        return view('redacoes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'introducao' => 'required|string',
            'desenvolvimento' => 'required|string',
            'conclusao' => 'required|string',
        ]);

        $redacao = Redacao::create([
            'RED_TEMA' => $validated['tema'],
            'RED_INTRODUCAO' => $validated['introducao'],
            'RED_DESENVOLVIMENTO' => $validated['desenvolvimento'],
            'RED_CONCLUSAO' => $validated['conclusao'],
            'RED_USU_CODIGO' => Auth::id(),
        ]);

        return redirect()->route('correcao.show', $redacao);
    }

    public function show(Redacao $redacao)
    {
        abort_unless($redacao->RED_USU_CODIGO === Auth::id(), 404);

        return view('redacoes.show', [
            'redacao' => $redacao,
            'correcao' => $redacao->correcao,
        ]);
    }

    public function update(Request $request, Redacao $redacao)
    {
        abort_unless($redacao->RED_USU_CODIGO === Auth::id(), 404);

        $redacao->correcao()->update(['COR_FOLHA' => 1]);

        return redirect()->route('redacoes.index')->with('success', 'Redação salva.');
    }

    public function destroy(Redacao $redacao)
    {
        abort_unless($redacao->RED_USU_CODIGO === Auth::id(), 404);

        $redacao->delete();

        return redirect()->route('redacoes.index')->with('success', 'Redação excluída.');
    }
}