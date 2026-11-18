@extends('layouts.app')
@section('content')

{{-- A correção é apresentada por partes para facilitar a leitura e a revisão. --}}
<main class="pagina-correcao">
    <header class="cabecalho-correcao">
        <a class="voltar-correcao" href="{{ route('redacoes.index') }}">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            Minhas redações
        </a>
        <p class="rotulo-correcao">REDAÇÃO ENEM</p>
        <h1>{{ $redacao->RED_TEMA }}</h1>
        <div class="meta-correcao">
            <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> Redação enviada</span>
            <span><i class="fa-solid fa-book-open" aria-hidden="true"></i> Correção automática</span>
            <strong><i class="fa-solid fa-check" aria-hidden="true"></i> Corrigida</strong>
        </div>
    </header>

    <nav class="abas-correcao" aria-label="Seções da redação">
        <a href="{{ route('redacoes.show', $redacao) }}">
            <i class="fa-regular fa-file-lines" aria-hidden="true"></i> Redação
        </a>
        <a class="ativa" href="#correcao"><i class="fa-regular fa-square-check" aria-hidden="true"></i> Correção</a>
    </nav>

    <div class="resumo-nota-correcao">
        <i class="fa-regular fa-star" aria-hidden="true"></i>
        <span>Nota geral</span>
        <strong>{{ $correcao->COR_NOTA }}<small>/1000</small></strong>
    </div>

    <div class="partes-correcao" id="correcao">
        @foreach ([
            ['numero' => '01', 'titulo' => 'Introdução', 'texto' => $redacao->RED_INTRODUCAO, 'dica' => 'Apresente o tema com clareza e antecipe os argumentos que serão desenvolvidos.'],
            ['numero' => '02', 'titulo' => 'Desenvolvimento', 'texto' => $redacao->RED_DESENVOLVIMENTO, 'dica' => 'Organize os argumentos, explique as relações entre as ideias e use repertório para sustentar sua tese.'],
            ['numero' => '03', 'titulo' => 'Conclusão', 'texto' => $redacao->RED_CONCLUSAO, 'dica' => 'Retome a tese e finalize com uma proposta de intervenção clara, completa e detalhada.'],
        ] as $parte)
            <section class="parte-correcao">
                <div class="titulo-parte-correcao">
                    <span>{{ $parte['numero'] }}</span>
                    <h2>{{ $parte['titulo'] }}</h2>
                </div>

                <div class="conteudo-parte-correcao">
                    <div class="analise-parte-correcao">
                        <h3><i class="fa-regular fa-message" aria-hidden="true"></i> O que precisa melhorar</h3>
                        <p class="trecho-analisado">{{ $parte['texto'] }}</p>
                        <p class="texto-apoio">A análise da IA considera a organização das ideias, a clareza dos argumentos e a adequação ao tema.</p>

                        <h3><i class="fa-solid fa-pen" aria-hidden="true"></i> Como corrigir</h3>
                        <p>{{ $parte['dica'] }}</p>

                        <div class="exemplo-reescrita">
                            <strong>EXEMPLO DE REESCRITA</strong>
                            <p>{{ $parte['texto'] }}</p>
                        </div>
                    </div>

                    <aside class="feedback-parte-correcao">
                        <i class="fa-regular fa-face-smile" aria-hidden="true"></i>
                        <strong>{{ $parte['titulo'] }} em evolução!</strong>
                        <p>Continue praticando: pequenos ajustes deixam seu texto mais consistente.</p>
                    </aside>
                </div>
            </section>
        @endforeach

    </div>

    <div class="acoes acoes-correcao">
        <section class="convite-debate">
            <div>
                <strong>Não concorda com a correção?</strong>
                <p>Abra um debate e explique seus argumentos sobre a nota ou o feedback.</p>
            </div>
            <a href="{{ route('debate.show', $redacao) }}">
                <i class="fa-solid fa-scale-balanced" aria-hidden="true"></i>
                Debater correção
            </a>
        </section>
    </div>
</main>

@endsection
