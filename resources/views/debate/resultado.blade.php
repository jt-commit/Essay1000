@extends('layouts.app')
@section('content')

{{-- Resposta do debate protegida por escape e apresentada no cartão de redação. --}}

    <main class="container-redacoes">
        <article class="folha">
            <h1>Resposta:</h1>

            <div class="debate">
                <p>{!! nl2br(e($debate)) !!}</p>
            </div>

            <div class="acoes">
                <a href="{{ route('redacoes.index') }}">Voltar</a>
            </div>
        </article>
    </main>

@endsection