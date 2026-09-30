<!DOCTYPE html>
<html lang="pt-br" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Essay1000')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @auth
        <link rel="stylesheet" href="{{ asset('css/' . (auth()->user()->tema->TEM_NOME ?? 'tema_padrao') . '.css') }}">
    @endauth
    @stack('styles')
</head>
<body>

    <div id="s1" class="a"></div>

    @auth
        <img src="{{ asset('assets/logo.png') }}" id="logo" class="a" onclick="window.location.href='{{ route('index') }}'">
        <img src="{{ asset('assets/perfil.png') }}" id="perfil" class="a" onclick="abrirperfil()">
        <img src="{{ asset('assets/engrenagem.png') }}" id="eng" class="a" onclick="window.location.href='{{ route('configuracao') }}'">

        <nav id="menu_p" class="a mf">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="sair" class="a cf">Sair</button>
            </form>
        </nav>
    @endauth

    @if (session('success'))
        <p class="mensagem-sucesso">{{ session('success') }}</p>
    @endif

    @if (session('erro'))
        <p class="mensagem-erro">{{ session('erro') }}</p>
    @endif

    @yield('content')

    <script>
    function abrirperfil(){
        let menu_p = document.getElementById("menu_p");
        if (menu_p.style.display === "none" || menu_p.style.display === "") {
            menu_p.style.display = "inline-block";
        } else {
            menu_p.style.display = "none";
        }
    }
    </script>

    @stack('scripts')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>