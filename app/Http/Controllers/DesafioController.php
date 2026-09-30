<?php

namespace App\Http\Controllers;

use App\Models\Redacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesafioController extends Controller
{
    // mostra a tela do modo desafio
    public function create()
    {
        return view('desafio.create');
    }

    // mesma lógica de salvar do RedacaoController@store,
    // só que o "tema" chega gerado pela IA (via rota /gerar-tema no front)
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
}