{{--
    View: configuracao/index.blade.php
    Função: Permite o usuário trocar o tema visual do site e o tamanho
    da fonte. Tem dois formulários independentes: um pra tema, outro
    pra fonte. Cada um envia pro seu próprio endpoint no Controller.
--}}
@extends('layouts.app')
@section('body-class', 'pagina-configuracoes')
@section('content')

    <main id="configuracoes" class="configuracoes-tela">
        <header class="configuracoes-cabecalho">
            <a class="configuracoes-voltar" href="{{ route('index') }}" aria-label="Voltar para o quadro de estudos">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i>
            </a>
            <div>
                <h1 id="tit3">Configurações do Sistema</h1>
                <p class="configuracoes-subtitulo">Ajuste a aparência e as preferências da plataforma.</p>
            </div>
        </header>

        <div class="conteudo-configuracoes">
            <p class="descricao-configuracoes">Personalize o tema e o tamanho da fonte da sua conta.</p>

            {{--
                Opções equivalentes aos controles de tema e fonte do configuracao.php.
                Os nomes enviados continuam sendo os campos aceitos pelos endpoints Laravel.
            --}}
            <div class="atalhos-configuracao">
                {{-- O botão reusa #visual, que o CSS original posiciona como atalho de temas. --}}
                <button id="visual" class="atalho-configuracao" type="button" onclick="abrirTemas()">
                    <span class="icone-configuracao" aria-hidden="true">
                        <i class="fa-solid fa-palette"></i>
                    </span>
                    <strong>Tela de Fundo</strong>
                    <p>Personalize a aparência: modo escuro e esquemas de cores.</p>
                    <span class="configuracoes-swatches" aria-hidden="true">
                        <i></i><i></i><i></i><i></i><i></i>
                    </span>
                    <span class="configuracoes-card-rodape">Personalizar <i class="fa-solid fa-arrow-right"></i></span>
                </button>

                {{-- Os tamanhos pequenos/médio/grande restauram as opções originais. --}}
                <form id="fontes" class="atalho-configuracao" action="{{ route('configuracao.fonte') }}" method="POST">
                    @csrf
                    <span class="icone-configuracao icone-fonte" aria-hidden="true">Aa</span>
                    <strong>Tamanho da fonte</strong>
                    @foreach ([14 => 'Pequena', 16 => 'Média', 18 => 'Grande'] as $tamanho => $rotulo)
                        <label>
                            <input type="radio" name="fonte" value="{{ $tamanho }}"
                                @checked((int) auth()->user()->USU_FONTE === $tamanho)>
                            {{ $rotulo }}
                        </label>
                    @endforeach
                    <span class="configuracoes-card-rodape">Ajustar <i class="fa-solid fa-arrow-right"></i></span>
                </form>

                <article class="atalho-configuracao card-informacao configuracao-ajuda" aria-labelledby="titulo-ajuda">
                    <span class="icone-configuracao" aria-hidden="true">
                        <i class="fa-regular fa-circle-question"></i>
                    </span>
                    <strong id="titulo-ajuda">Ajuda</strong>
                    <p>Encontre orientações para escrever, revisar e evoluir suas redações.</p>
                    <span class="configuracoes-pills"><b>Tutoriais</b><b>Suporte</b><b>Dúvidas</b></span>
                    <span class="configuracoes-card-rodape">Abrir ajuda <i class="fa-solid fa-arrow-right"></i></span>
                </article>

                <article class="atalho-configuracao card-informacao configuracao-sobre" aria-labelledby="titulo-sobre">
                    <span class="icone-configuracao" aria-hidden="true">
                        <i class="fa-solid fa-circle-info"></i>
                    </span>
                    <strong id="titulo-sobre">Sobre</strong>
                    <p>Conheça o Essay1000 e os recursos criados para apoiar seus estudos.</p>
                    <span class="configuracoes-pills"><b>Versão 1.0</b><b>Termos</b></span>
                    <span class="configuracoes-card-rodape">Ver detalhes <i class="fa-solid fa-arrow-right"></i></span>
                </article>
            </div>
        </div>
    </main>

    {{-- Painel original #vi1: as linhas #vi4-#vi6 são os alvos das regras antigas do style.css. --}}
    <form id="vi1" class="a c1" action="{{ route('configuracao.tema') }}" method="POST" aria-label="Escolha do tema">
        @csrf
        <h2 id="vi2" class="a e cfc">Defina um Visual Para o Fundo de sua Aplicação</h2>

        @foreach ($temas->sortBy('TEM_CODIGO')->take(3) as $tema)
            <div id="vi{{ $loop->iteration + 3 }}" class="a vi3 cfc">
                <label>
                    <input type="radio" name="tema" value="{{ $tema->TEM_CODIGO }}"
                                @checked((string) auth()->user()->USU_TEM_CODIGO === (string) $tema->TEM_CODIGO || (!auth()->user()->USU_TEM_CODIGO && $tema->TEM_NOME === 'tema_padrao'))>
                    <span>{{ str_replace('_', ' ', $tema->TEM_NOME) }}</span>
                </label>
            </div>
        @endforeach

        <button type="button" id="so7" class="a bf" onclick="fecharTemas()">Voltar</button>
        <button type="submit" class="salvar-temas bf">Salvar tema</button>
    </form>

    {{-- Os handlers só alternam o painel; o tema é salvo pelo formulário Laravel acima. --}}
    <script>
        function abrirTemas() {
            document.getElementById('configuracoes').style.display = 'none';
            document.getElementById('vi1').style.display = 'block';
        }

        function fecharTemas() {
            document.getElementById('vi1').style.display = 'none';
            document.getElementById('configuracoes').style.display = 'flex';
        }
    </script>

@endsection