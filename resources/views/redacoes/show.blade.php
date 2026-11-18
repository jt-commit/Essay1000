@extends('layouts.app')
@section('content')

{{-- A visualização da redação fica separada da tela de correção. --}}
<main class="pagina-correcao pagina-redacao">
    <header class="cabecalho-correcao">
        <a class="voltar-correcao" href="{{ route('redacoes.index') }}">
            <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            Minhas redações
        </a>
        <p class="rotulo-correcao">REDAÇÃO ENEM</p>
        <h1>{{ $redacao->RED_TEMA }}</h1>
        <div class="meta-correcao">
            <span><i class="fa-regular fa-file-lines" aria-hidden="true"></i> Texto dissertativo</span>
            @if ($correcao)
                <strong><i class="fa-solid fa-check" aria-hidden="true"></i> Corrigida</strong>
            @endif
        </div>
    </header>

    <nav class="abas-correcao" aria-label="Ações da redação">
        <a class="ativa" href="#redacao"><i class="fa-regular fa-file-lines" aria-hidden="true"></i> Redação</a>
        @if ($correcao)
            <a href="{{ route('correcao.show', $redacao) }}">
                <i class="fa-regular fa-square-check" aria-hidden="true"></i> Correção
            </a>
        @endif
    </nav>

    <div class="conteudo-correcao">
        <article class="folha-correcao" id="redacao">
            <div class="cabecalho-folha">
                <span>CADERNO DE REDAÇÃO</span>
                <span>TEXTO DISSERTATIVO</span>
            </div>

            <section class="secao-redacao">
                <span class="numero-secao">01</span>
                <div>
                    <h2>Introdução</h2>
                    <p>{{ $redacao->RED_INTRODUCAO }}</p>
                </div>
            </section>

            <section class="secao-redacao">
                <span class="numero-secao">02</span>
                <div>
                    <h2>Desenvolvimento</h2>
                    <p>{{ $redacao->RED_DESENVOLVIMENTO }}</p>
                </div>
            </section>

            <section class="secao-redacao">
                <span class="numero-secao">03</span>
                <div>
                    <h2>Conclusão</h2>
                    <p>{{ $redacao->RED_CONCLUSAO }}</p>
                </div>
            </section>
        </article>

        <aside class="painel-lateral-correcao">
            <section class="bloco-correcao bloco-notas">
                <i class="fa-solid fa-pen-nib" aria-hidden="true"></i>
                <h2>Meu bloco</h2>
                <p>Revise suas ideias e acompanhe a evolução do seu texto.</p>
            </section>

            <section class="bloco-correcao bloco-comentarios">
                <h2><i class="fa-solid fa-list-check" aria-hidden="true"></i> Estrutura da redação</h2>
                <p><i class="fa-regular fa-square-check" aria-hidden="true"></i> Introdução</p>
                <p><i class="fa-regular fa-square-check" aria-hidden="true"></i> Desenvolvimento</p>
                <p><i class="fa-regular fa-square-check" aria-hidden="true"></i> Conclusão</p>
            </section>
        </aside>
    </div>

</main>
@endsection