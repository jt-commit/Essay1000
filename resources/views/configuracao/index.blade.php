{{--
    View: configuracao/index.blade.php
    Função: Permite o usuário trocar o tema visual do site e o tamanho
    da fonte. Tem dois formulários independentes: um pra tema, outro
    pra fonte. Cada um envia pro seu próprio endpoint no Controller.
--}}
@extends('layouts.app')
@section('content')

    <h1>Configuração</h1>

    {{-- Formulário para trocar o tema visual do site --}}
    <form action="{{ route('configuracao.tema') }}" method="POST">
        @csrf

        {{-- Lista suspensa com todos os temas cadastrados no banco --}}
        <select name="tema">
            @foreach ($temas as $tema)
                {{-- Cada opção usa o código do tema como valor, e o nome como texto exibido --}}
                <option value="{{ $tema->TEM_CODIGO }}">{{ $tema->TEM_NOME }}</option>
            @endforeach
        </select>

        <button type="submit">Salvar Tema</button>
    </form>

    {{-- Formulário para trocar o tamanho da fonte --}}
    <form action="{{ route('configuracao.fonte') }}" method="POST">
        @csrf
        <input type="number" name="fonte" placeholder="Tamanho da Fonte">
        <button type="submit">Salvar Fonte</button>
    </form>

@endsection