@extends('layouts.app')

@section('content')

    {{-- Lista equivalente a redacoes.php; o Controller entrega apenas redações do usuário autenticado. --}}
    <main class="container-redacoes">
        <h1 id="tit1" class="a">Suas Redações</h1>
        @forelse ($redacoes as $redacao)
            {{-- Card .folha e ações .acoes preservam os seletores do CSS original. --}}
            <article class="folha">
                <div class="icone" aria-hidden="true">📄</div>
                <h3>{{ $redacao->RED_TEMA }}</h3>

                @if ($redacao->correcao)
                    <p>Nota: {{ $redacao->correcao->COR_NOTA }}</p>
                @else
                    <p>Aguardando correção...</p>
                @endif

                <div class="acoes">
                    <a href="{{ route('redacoes.show', $redacao) }}">Visualizar</a>
                    <form action="{{ route('redacoes.destroy', $redacao) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </div>
            </article>
        @empty
            <p>Você ainda não escreveu nenhuma redação.</p>
        @endforelse
    </main>

@endsection