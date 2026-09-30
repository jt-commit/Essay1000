@extends('layouts.app')
@section('content')

<h1>Resultado da Correção</h1>

<div class="nota">
    <p>Nota: {{ $correcao ->COR_NOTA}} / 1000</p>
</div>

<div class="correcao">
    {!! nl2br(e($correcao->COR_TEXTO)) !!}
</div>

<a href="{{ route('redacoes.index') }}">Voltar para Minhas Redações</a>

@endsection
