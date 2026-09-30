<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function index()
    {
        return view('temas.index', ['temas' => Tema::all()]);
    }

    public function create()
    {
        return view('temas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'TEM_NOME' => 'required|string|max:50',
            'TEM_ATIVO' => 'boolean',
        ]);

        Tema::create($validated);

        return redirect()->route('temas.index')->with('success', 'Tema criado.');
    }

    public function show(Tema $tema)
    {
        return view('temas.show', compact('tema'));
    }

    public function edit(Tema $tema)
    {
        return view('temas.edit', compact('tema'));
    }

    public function update(Request $request, Tema $tema)
    {
        $validated = $request->validate([
            'TEM_NOME' => 'required|string|max:50',
            'TEM_ATIVO' => 'boolean',
        ]);

        $tema->update($validated);

        return redirect()->route('temas.index')->with('success', 'Tema atualizado.');
    }

    public function destroy(Tema $tema)
    {
        $tema->delete();
        return redirect()->route('temas.index')->with('success', 'Tema removido.');
    }
}