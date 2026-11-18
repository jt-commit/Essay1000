<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Essay1000</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Cabeçalho e cartão preservam a estrutura do login.php original. -->
    <div id="s1" class="a"></div>
    <img src="{{ asset('assets/logo.png') }}" id="logo" class="a">

    <main class="container-central">
        <div class="cartao-login">

            <div class="lado-imagem">
                <img src="{{ asset('assets/Folha-enem.png') }}" id="livro" class="a" alt="Folha de redação sobre uma mesa de estudos">
            </div>

            <div class="lado-formulario2">
                <h1>Login</h1>
                <p class="descricao">Preencha os campos abaixo para entrar em sua conta</p>

                @if ($errors->any())
                    <p class="erro-login">{{ $errors->first() }}</p>
                @endif

                <form action="{{ route('login') }}" method="POST" class="formulario-login">
                    @csrf

                    <div class="grupo-campo">
                        <i class="fa-regular fa-envelope campo-icone" aria-hidden="true"></i>
                        <input type="email" id="email" name="USU_EMAIL" value="{{ old('USU_EMAIL') }}" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="grupo-campo">
                        <i class="fa-solid fa-lock campo-icone" aria-hidden="true"></i>
                        <input type="password" id="senha" name="USU_SENHA" placeholder="Digite sua senha" required>
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