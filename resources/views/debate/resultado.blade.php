@extends('layouts.app')
@section('content')

{{-- RESPOSTA DO DEBATE --}}

    <h1>Resposta:</h1>

    <div class="debate">
        <p>{!! nl2br(e($debate)) !!}</p>
    </div>

    <a href="{{ route('redacoes.index') }}">Voltar</a>

@endsection