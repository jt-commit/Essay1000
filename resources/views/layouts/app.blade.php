<!DOCTYPE html>
{{-- O CSS de tema original continua sendo carregado; data-theme alimenta os tokens do CSS consolidado. --}}
<html lang="pt-br" data-theme="{{ match (strtolower(auth()->user()?->tema?->TEM_NOME ?? '')) { 'tema_noturno', 'dark' => 'dark', 'tema_beta', 'hybrid' => 'hybrid', 'tema_padrao', 'light' => 'light', default => 'light' } }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Essay1000')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @auth
        <link rel="stylesheet" href="{{ asset('css/' . (auth()->user()->tema->TEM_NOME ?? 'tema_padrao') . '.css') }}">
    @endauth
    @stack('styles')
</head>
{{-- Views podem fornecer classes de página sem duplicar o layout compartilhado. --}}
<body class="@yield('body-class')">

    {{-- IDs do cabeçalho mantidos conforme o PHP original e o CSS legado. --}}
    <div id="s1" class="a"></div>

    @auth
        <img src="{{ asset('assets/logo.png') }}" id="logo" class="a" alt="Essay1000" onclick="window.location.href='{{ route('index') }}'">
        <button type="button" id="perfil" class="a cabecalho-icone" aria-label="Abrir menu do perfil" aria-expanded="false" onclick="abrirperfil()">
            <i class="fa-solid fa-user" aria-hidden="true"></i>
        </button>
        <button type="button" id="eng" class="a cabecalho-icone" aria-label="Abrir configurações de tema" onclick="window.location.href='{{ route('configuracao') }}'">
            <i class="fa-solid fa-moon" aria-hidden="true"></i>
        </button>

        <nav id="menu_p" class="a mf painel-perfil" aria-label="Menu do perfil">
            <header class="painel-perfil-cabecalho">
                <div class="painel-perfil-avatar">
                    <i class="fa-regular fa-user" aria-hidden="true"></i>
                </div>
                <div>
                    <strong>{{ auth()->user()->USU_NOME ?: 'Usuário' }}</strong>
                    <small>{{ auth()->user()->USU_EMAIL }}</small>
                </div>
            </header>

            <p class="painel-perfil-selo">
                <i class="fa-solid fa-medal" aria-hidden="true"></i>
                Medalha: Boas-vindas
            </p>

            <div class="painel-perfil-opcoes">
                <a href="{{ route('index') }}" class="painel-perfil-opcao ativo">
                    <i class="fa-regular fa-user" aria-hidden="true"></i>
                    <span>Perfil</span>
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('configuracao') }}" class="painel-perfil-opcao">
                    <i class="fa-solid fa-sun" aria-hidden="true"></i>
                    <span>Configurações</span>
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </a>
                <a href="{{ route('home') }}" class="painel-perfil-opcao">
                    <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
                    <span>Sobre</span>
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>

            <div class="painel-perfil-sair">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" id="sair" class="cf">
                        <i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i>
                        Sair
                    </button>
                </form>
            </div>

            <small class="painel-perfil-versao">Essay1000 · v1.0</small>
        </nav>
    @endauth

    @if (session('success'))
        <p class="mensagem-sucesso">{{ session('success') }}</p>
    @endif

    @if (session('erro'))
        <p class="mensagem-erro">{{ session('erro') }}</p>
    @endif

    @if (session()->has('cadastro_sucesso'))
        <div class="modal-cadastro-sucesso" role="dialog" aria-modal="true" aria-labelledby="modal-cadastro-titulo">
            <div class="modal-cadastro-cartao">
                <button type="button" class="modal-cadastro-fechar" aria-label="Fechar" onclick="fecharCadastroSucesso()">×</button>
                <img class="modal-cadastro-medalha" src="{{ asset('assets/medalha.png') }}" alt="Medalha de cadastro realizado">
                <h2 id="modal-cadastro-titulo">Cadastro realizado com<br>sucesso!</h2>
                <p>Sua conta foi criada. Estamos felizes em ter você conosco!</p>
                <button type="button" class="modal-cadastro-continuar" onclick="fecharCadastroSucesso()">Continuar</button>
            </div>
        </div>
    @endif

    @if (session()->has('login_sucesso'))
        <div class="confetes-login" aria-hidden="true"></div>
    @endif

    @yield('content')

    <script>
    function abrirperfil(){
        let menu_p = document.getElementById("menu_p");
        let perfil = document.getElementById("perfil");
        const aberto = menu_p.classList.toggle("aberto");

        perfil.setAttribute("aria-expanded", aberto ? "true" : "false");
    }

    function fecharCadastroSucesso(){
        const modal = document.querySelector('.modal-cadastro-sucesso');

        if (modal) {
            modal.remove();
        }
    }

    // Cria os confetes somente no carregamento gerado pelo login ou cadastro.
    const confetes = document.querySelector('.confetes-login');

    if (confetes) {
        for (let indice = 0; indice < 36; indice += 1) {
            const confete = document.createElement('span');

            confete.className = 'confete-login';
            confete.style.setProperty('--confete-x', `${Math.random() * 100}vw`);
            confete.style.setProperty('--confete-atraso', `${Math.random() * 1.8}s`);
            confete.style.setProperty('--confete-duracao', `${3.4 + Math.random() * 2.4}s`);
            confete.style.setProperty('--confete-cor', ['#20a653', '#1687e8', '#ffd21f', '#d9363e', '#f28c28'][indice % 5]);
            confete.style.setProperty('--confete-tamanho', `${6 + Math.random() * 7}px`);
            confetes.appendChild(confete);
        }
    }
    </script>

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>