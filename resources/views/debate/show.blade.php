{{--
    View: debate/show.blade.php
    Função: Permite o aluno contestar a nota da correção, enviando um
    argumento que será analisado pela IA via debate. Mostra a nota atual
    e um formulário para o aluno escrever seu argumento.
--}}
@extends('layouts.app')
@section('content')

    <h1>Debate</h1>

    {{-- Mostra a nota atual da correção, pra dar contexto ao aluno --}}
    <div class="correcao">
        <p>Nota atual: {{ $redacao->correcao->COR_NOTA }}</p>
    </div>

    {{-- Mostra erro caso o argumento venha vazio na validação --}}
    @if ($errors->any())
        <p class="erro-login">{{ $errors->first() }}</p>
    @endif

    {{-- Formulário onde o aluno escreve o argumento pra contestar a nota --}}
    <form action="{{ route('debate.store', $redacao) }}" method="POST">
        @csrf
        <textarea name="argumento" placeholder="Adicione o seu argumento"></textarea>
        <button type="submit">Enviar Argumento</button>
    </form>

    {{-- Link de volta pra lista de redações --}}
    <a href="{{ route('redacoes.index') }}">Voltar</a>

@endsection