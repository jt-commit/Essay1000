<?php

require_once __DIR__ . '/auth.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once __DIR__ . '/db.php';

if (!isset($pdo) || !$pdo) {
    exit('Erro de conexão com o banco.');
}

$id = $_SESSION['USU_CODIGO'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $tema = $_POST['tema'];

    $introducao = $_POST['introducao'];

    $desenvolvimento = $_POST['desenvolvimento'];

    $conclusao = $_POST['conclusao'];

    $stmt = $pdo->prepare("

        INSERT INTO REDACAO
        (
            RED_TEMA,
            RED_INTRODUCAO,
            RED_DESENVOLVIMENTO,
            RED_CONCLUSAO,
            RED_USU_CODIGO
        )

        VALUES (?, ?, ?, ?, ?)

    ");

    $stmt->execute([

        $tema,
        $introducao,
        $desenvolvimento,
        $conclusao,
        $id

    ]);

    // pega ID da redação criada
    $redacaoId = $pdo->lastInsertId();

    // redireciona para correção
    header("Location: correcao.php?id=$redacaoId");
    exit();
}

/* FORA DO IF */

$stmt = $pdo->prepare("
    SELECT * FROM USUARIO
    WHERE USU_CODIGO = ?
");

$stmt->execute([$id]);

$usuario = $stmt->fetch();

?>

<!DOCTYPE html>

<html lang="pt-br">
    
<head>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div id="s1" class="a"></div>

<img src="assets/logo.png" id="logo" class="a">

<img src="assets/perfil.png"
id="perfil"
onclick="abrirperfil()"
alt="..."
class="a">

<img src="assets/barra.png"
id="barra"
onclick="abrirmenu()"
alt="..."
class="a">

<form method="POST">

<div id="caixa3" class="a">
     
    <h1 id="criartema" class="a">
        Escreva seu Tema Abaixo
    </h1>

    <input
    type="text"
    placeholder="tema aqui..."
    class="a"
    id="tema"
    name="tema">

    <img
    src="assets/lapis.png"
    id="lapis"
    class="a"
    onclick="enviar();aparecer();">

</div>

<div id="criaredacao" class="a">
     
    <div id="titulo" class="a">

        <h1 id="resultado" class="a"></h1>

    </div>

    <div id="introducao" class="a">

        <p>Introdução</p>

        <textarea
        id="texto1"
        name="introducao"
        minlength="240"
        maxlength="480"></textarea>

    </div>

    <div id="desenvolvimento" class="a">

        <p>Desenvolvimento</p>

        <textarea
        id="texto2"
        name="desenvolvimento"
        minlength="360"
        maxlength="1100"></textarea>

    </div>

    <div id="conclusao" class="a">

        <p>Conclusão</p>

        <textarea
        id="texto3"
        name="conclusao"
        minlength="240"
        maxlength="480"></textarea>

    </div>

    <button type="submit" id="cr" class="a">
        Criar
    </button>

</div>

</form>

<nav id="menu_p" class="a">

    <h1 id="np">
        <?= $usuario['USU_NOME']; ?>
    </h1>

    <a href="logout.php" class="a" id="sair">
        sair
    </a>

</nav>

<nav id="menu" class="a">

    <button id="b1" class="a" onclick="novaredacao()">
        Nova Redação
    </button>

    <button id="b2" class="a" onclick="minhas_redacoes()">
        Redações
    </button>

    <button id="b3" class="a" onclick="configuracoes()">
        Configurações
    </button>

</nav>

<div id="configuracoes" class="a">
       
    <button id="fechar" class="a" onclick="FecharConfiguracoes()">
        X
    </button>

    <h1 id="tit2" class="a">
        Configurações
    </h1>

    <p id="mensagem" class="a">
        Não há configurações no momento
    </p>

</div>

<script>

function abrirmenu(){

    let menu = document.getElementById("menu");
    let menu_p = document.getElementById("menu_p");

    if(menu.style.display === "none"){

        menu.style.display = "inline-block";
        menu_p.style.display = "none";

    }else{

        menu.style.display = "none";
    }
}

function abrirperfil(){

    let menu_p = document.getElementById("menu_p");

    if(menu_p.style.display === "none"){

        menu_p.style.display = "inline-block";
        menu.style.display = "none";

    }else{

        menu_p.style.display = "none";
    }
}

function novaredacao(){

    window.location.href = "novaredacao.php";
}

function minhas_redacoes(){

    window.location.href = "minhas_redacoes.php";
}

function configuracoes(){

    document.getElementById("configuracoes").style.display = "block";
}

function FecharConfiguracoes(){

    document.getElementById("configuracoes").style.display = "none";
}

function enviar(){

    let valor = document.getElementById("tema").value;

    document.getElementById("resultado").innerText = valor;
}

function aparecer(){

    let criaredacao = document.getElementById("criaredacao");

    if(criaredacao.style.display === "none"){

        criaredacao.style.display = "block";

    }else{

        criaredacao.style.display = "none";
    }
}

</script>

</body>

</html>
```
