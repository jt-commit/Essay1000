<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Essay1000</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div id="s1" class="a"></div>
    <img src="{{ asset('assets/logo.png') }}" id="logo" class="a">

    <main class="container-central">
        <div class="cartao-login">

            <div class="lado-imagem">
                <img src="{{ asset('assets/livro.jpg') }}" id="livro" class="a" alt="Livros">
            </div>

            <div class="lado-formulario">
                <h1>Login</h1>
                <p class="descricao">Preencha os campos abaixo para entrar em sua conta</p>

                @if ($errors->any())
                    <p class="erro-login">{{ $errors->first() }}</p>
                @endif

                <form action="{{ route('login') }}" method="POST" class="formulario-login">
                    @csrf

                    <div class="grupo-campo">
                        <input type="email" name="USU_EMAIL" value="{{ old('USU_EMAIL') }}" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="grupo-campo">
                        <input type="password" name="USU_SENHA" placeholder="Digite sua senha" required>
                    </div>

                    <button type="submit" class="botao-entrar">Entrar</button>

                    <p class="texto-cadastro">
                        Não tem uma conta? <a href="{{ route('register') }}">Cadastre-se agora!</a>
                    </p>
                </form>
            </div>

        </div>
    </main>

</body>
</html>