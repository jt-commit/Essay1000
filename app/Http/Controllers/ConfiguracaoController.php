<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracaoController extends Controller
{
    public function index(Request $request)
    {
        $temas = \App\Models\Tema::all();
        return view('configuracao.index', [
            'origem' => $request->query('origem', 'index'),
            'temas' => $temas,
        ]);
    }

    public function salvarTema(Request $request)
    {
        $request->validate(['tema' => 'required|exists:tema,TEM_CODIGO']);
        Auth::user()->update(['USU_TEM_CODIGO' => $request->tema]);

        return redirect()->route('configuracao')->with('success', 'Tema atualizado com sucesso.');
    }

    public function salvarFonte(Request $request)
    {
        $request->validate(['fonte' => 'required|integer']);
        Auth::user()->update(['USU_FONTE' => $request->fonte]);

        return redirect()->route('configuracao')->with('success', 'Fonte atualizada com sucesso.');
    }
}