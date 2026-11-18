<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Essay1000 | Sua melhor escrita</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="home-page">
    <header class="home-cabecalho">
        <a href="{{ url('/') }}" class="home-logo" aria-label="Essay1000 - início">
            <img src="{{ asset('assets/logo-2.png') }}" alt="Essay1000">
        </a>

        <nav class="home-navegacao" aria-label="Navegação principal">
            <a href="{{ route('login') }}" class="btn-login-home">Entrar</a>
            <a href="{{ route('register') }}" class="btn-cadastro-home">Cadastrar</a>
        </nav>
    </header>

    <main class="home-scroll">
        <section class="home-secao home-principal" aria-labelledby="home-titulo">
            <div class="home-apresentacao">
                <div class="home-texto">
                    <p class="home-subtitulo">Sua voz. Sua melhor escrita.</p>

                    <h1 id="home-titulo">
                        A clareza que<br>
                        seu <span>texto</span><br>
                        exige.
                    </h1>

                    <p class="parag-home">
                        Transforme ideias complexas em uma redação clara, forte e bem
                        estruturada — sem perder a sua voz no caminho.
                    </p>

                    <div class="home-acoes">
                        <a href="{{ route('login') }}" class="botao-home">Começar redação</a>
                        <a href="#metodo" class="metodo-home">Conhecer método</a>
                    </div>
                </div>

                <div class="home-imagem" aria-label="Pessoa escrevendo uma redação">
                    <div class="home-moldura-imagem">
                        <img src="{{ asset('assets/MãoEscrevendo.png') }}" alt="Pessoa escrevendo à mão">
                    </div>
                    <p class="home-nota">
                        Pensamentos organizados.<br>
                        Textos mais fortes. Uma escrita<br class="home-nota-quebra">
                        realmente sua.
                    </p>
                </div>
            </div>
        </section>

        <section class="home-secao home-metodologia" id="metodo" aria-labelledby="metodo-titulo">
            <div class="home-postits" aria-label="Pilares da metodologia">
                <article class="home-postit home-postit-azul">
                    <small>ESTRUTURA</small>
                    <strong>Ideias bem<br>conectadas</strong>
                </article>
                <article class="home-postit home-postit-verde">
                    <small>CLAREZA</small>
                    <strong>Leitura fluida e<br>objetiva</strong>
                </article>
                <article class="home-postit home-postit-rosa">
                    <small>AUTONOMIA</small>
                    <strong>Sua voz em cada<br>parágrafo</strong>
                </article>
            </div>

            <div class="home-metodologia-conteudo">
                <p class="home-secao-kicker">METODOLOGIA ESSAY1000</p>
                <h1 id="metodo-titulo">Da primeira ideia<br>à versão final.</h1>

                <div class="home-etapas">
                    <article>
                        <b>01</b>
                        <h2>Diagnóstico editorial</h2>
                        <p>Identifique oportunidades de melhoria na estrutura, na coesão e no desenvolvimento dos argumentos.</p>
                    </article>
                    <article>
                        <b>02</b>
                        <h2>Refinamento do texto</h2>
                        <p>Fortaleça a tese, escolha palavras mais precisas e dê ritmo a cada parágrafo.</p>
                    </article>
                    <article>
                        <b>03</b>
                        <h2>Evolução contínua</h2>
                        <p>Entenda os ajustes e leve o aprendizado para todas as suas próximas redações.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="home-secao home-evolucao" aria-labelledby="evolucao-titulo">
            <div class="home-evolucao-conteudo">
                <div>
                    <p class="home-secao-kicker">ESCREVER TAMBÉM É APRENDER</p>
                    <h1 id="evolucao-titulo">Mais do que corrigir,<br><span>ajudamos você a evoluir.</span></h1>
                    <p class="home-evolucao-texto">Cada observação deve fazer sentido. Por isso, o foco está em mostrar caminhos para um texto mais consistente, mantendo suas ideias e seu estilo.</p>
                    <ul class="home-beneficios">
                        <li>Orientação direta e compreensível</li>
                        <li>Foco em argumentação e coesão</li>
                        <li>Aprendizado que fica para o próximo texto</li>
                    </ul>
                </div>

                <div class="home-folha" aria-label="Exemplo de análise de texto">
                    <small>EXEMPLO DE ANÁLISE</small>
                    <h2>A força de uma boa introdução</h2>
                    <p>Uma tese clara orienta o leitor e prepara o desenvolvimento dos argumentos ao longo da redação.</p>
                    <strong>Sugestão: apresente o ponto central com mais precisão e antecipe os dois argumentos principais.</strong>
                    <a href="{{ route('login') }}">EXPERIMENTAR AGORA →</a>
                </div>
            </div>
        </section>

        <section class="home-secao home-final" aria-labelledby="final-titulo">
            <div class="home-chamada">
                <div>
                    <p class="home-secao-kicker">SEU PRÓXIMO TEXTO COMEÇA AQUI</p>
                    <h1 id="final-titulo">Dê mais força às suas ideias.</h1>
                </div>
                <a href="{{ route('register') }}">CRIAR MINHA CONTA →</a>
            </div>

            <footer class="home-rodape">
                <div>
                    <strong>ESSAY1000</strong>
                    <p>Clareza para escrever. Confiança para avançar.</p>
                </div>
                <div class="home-rodape-links">
                    <div><small>PLATAFORMA</small><a href="#metodo">Metodologia</a><a href="#evolucao-titulo">Recursos</a></div>
                    <div><small>CONTA</small><a href="{{ route('login') }}">Entrar</a><a href="{{ route('register') }}">Cadastrar</a></div>
                    <div><small>SUPORTE</small><a href="mailto:contato@essay1000.com">Contato</a></div>
                </div>
            </footer>
        </section>
    </main>
</body>
</html>