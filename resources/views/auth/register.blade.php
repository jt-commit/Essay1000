<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Essay1000</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Cabeçalho e cartão preservam a estrutura do register.php original. -->
    <div id="s1" class="a"></div>
    <img src="{{ asset('assets/logo.png') }}" id="logo" class="a">

    <main class="container-central">
        <div class="cartao-login">

            <div class="lado-imagem">
                <img src="{{ asset('assets/Folha-enem.png') }}" id="computador" class="a" alt="Folha de redação sobre uma mesa de estudos">
            </div>

            <div class="lado-formulario">
                <h1>Cadastro</h1>
                <p class="descricao">Preencha as informações abaixo para se cadastrar</p>

                @if ($errors->any())
                    <p class="erro-login">{{ $errors->first() }}</p>
                @endif

                <form action="{{ route('register') }}" method="POST" class="formulario-login">
                    @csrf

                    <div class="grupo-campo">
                        <i class="fa-regular fa-envelope campo-icone" aria-hidden="true"></i>
                        <input type="email" id="email" name="USU_EMAIL" value="{{ old('USU_EMAIL') }}" placeholder="E-mail" required>
                    </div>

                    <div class="grupo-campo">
                        <i class="fa-solid fa-lock campo-icone" aria-hidden="true"></i>
                        <input type="password" id="senha" name="USU_SENHA" placeholder="Senha" required>
                    </div>

                    <div class="grupo-campo">
                        <i class="fa-solid fa-graduation-cap campo-icone" aria-hidden="true"></i>
                        <select name="USU_ESCOLARIDADE" id="escolaridade" class="select-customizado" required>
                            <option value="">Escolaridade</option>
                            <option value="fundamental" @selected(old('USU_ESCOLARIDADE') === 'fundamental')>Ensino Fundamental</option>
                            <option value="medio" @selected(old('USU_ESCOLARIDADE') === 'medio')>Ensino Médio</option>
                            <option value="superior" @selected(old('USU_ESCOLARIDADE') === 'superior')>Ensino Superior</option>
                        </select>
                    </div>

                    <div class="grupo-campo">
                        <i class="fa-solid fa-school campo-icone" aria-hidden="true"></i>
                        <input type="text" id="local-estudo" name="USU_LOCAL-ESTUDO" value="{{ old('USU_LOCAL-ESTUDO') }}" placeholder="Onde você estuda?" required>
                    </div>



                    <button type="submit" class="botao-entrar">Cadastrar</button>

                    <p class="texto-cadastro">
                        Já tem uma conta? <a href="{{ route('login') }}">Faça login aqui!</a>
                    </p>
                </form>
            </div>

        </div>
    </main>

</body>
</html>