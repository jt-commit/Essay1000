@extends('layouts.app')

@section('content')

    {{-- Tela que exibe as redações feitas pelo usuario --}}

    @forelse ($redacoes as $redacao)

        <p>Tema: {{ $redacao->RED_TEMA }}</p>

        @if ($redacao->correcao)
            <p>Nota: {{ $redacao->correcao->COR_NOTA }}</p>
        @else
            <p>Aguardando correção...</p>
        @endif

        <a href="{{ route('redacoes.show', $redacao) }}">Ver detalhes</a>

    @empty
        <p>Você ainda não escreveu nenhuma redação.</p>
    @endforelse

@endsection