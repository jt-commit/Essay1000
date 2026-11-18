@extends('layouts.app')

{{-- A classe preserva o gancho de estilos específico da tela inicial. --}}
@section('body-class', 'pagina-inicial-dark')

@section('content')
    <main class="activity-dashboard">
        <section class="activity-summary" aria-label="Resumo dos estudos">
            <p class="activity-summary-kicker">ÁREA DO ALUNO</p>
            <h1 class="activity-title">Quadro de Estudos</h1>
            <div class="activity-stats">
                <article>
                    <div class="activity-stat-head">
                        <div>
                            <strong>0</strong>
                            <span>Redações feitas</span>
                        </div>
                        <i class="fa-solid fa-book-open-reader" aria-hidden="true"></i>
                    </div>
                    <small>+0 neste mês</small>
                </article>
                <article>
                    <div class="activity-stat-head">
                        <div>
                            <strong>0</strong>
                            <span>Debates em aberto</span>
                        </div>
                        <i class="fa-solid fa-comments" aria-hidden="true"></i>
                    </div>
                    <small>+0 neste mês</small>
                </article>
            </div>
        </section>

        <section class="activity-board" aria-labelledby="activity-board-title">
            <div class="activity-board-heading">
                <p class="activity-board-kicker">ESCOLHA UM CAMINHO</p>
                <h2 id="activity-board-title">Continue sua evolução</h2>
                <p>Pequenos passos constroem textos mais fortes.</p>
            </div>

            <a class="post-it post-it-blue" href="{{ route('redacoes.create') }}">
                <span>COMECE POR AQUI</span>
                <span class="post-it-icone" aria-hidden="true"><i class="fa-regular fa-pen-to-square"></i></span>
                <strong>Criar redação</strong>
                <small>Escolha um tema e desenvolva seu próximo texto.</small>
                <b>Começar agora →</b>
            </a>
            <a class="post-it post-it-yellow" href="{{ route('redacoes.index') }}">
                <span>SEU ARQUIVO</span>
                <span class="post-it-icone" aria-hidden="true"><i class="fa-regular fa-folder-open"></i></span>
                <strong>Minhas redações</strong>
                <small>Continue rascunhos e releia os textos que você já escreveu.</small>
                <b>Ver redações →</b>
            </a>
            <a class="post-it post-it-coral" href="{{ route('desafio.create') }}">
                <span>CONTRA O RELÓGIO</span>
                <span class="post-it-icone" aria-hidden="true"><i class="fa-regular fa-clock"></i></span>
                <strong>Modo desafio</strong>
                <small>Receba um tema aleatório e escreva dentro do tempo.</small>
                <b>Aceitar desafio →</b>
            </a>
            <a class="post-it post-it-green" href="{{ route('temas.index') }}">
                <span>PARA PRATICAR</span>
                <span class="post-it-icone" aria-hidden="true"><i class="fa-regular fa-lightbulb"></i></span>
                <strong>Banco de temas</strong>
                <small>Encontre propostas para ampliar seu repertório e treinar.</small>
                <b>Explorar temas →</b>
            </a>
            <a class="post-it post-it-purple" href="{{ route('redacoes.index') }}">
                <span>SUA EVOLUÇÃO</span>
                <span class="post-it-icone" aria-hidden="true"><i class="fa-solid fa-chart-line"></i></span>
                <strong>Desempenho</strong>
                <small>Acompanhe seus pontos fortes e o que ainda pode melhorar.</small>
                <b>Ver progresso →</b>
            </a>
            <a class="post-it post-it-cream" href="{{ route('redacoes.create') }}">
                <span>SALA DE ESTUDO</span>
                <span class="post-it-icone" aria-hidden="true"><i class="fa-solid fa-book-open"></i></span>
                <strong>Conteúdos</strong>
                <small>Revisite estrutura, argumentação, coesão e outros fundamentos.</small>
                <b>Continuar estudando →</b>
            </a>
        </section>
    </main>

@endsection