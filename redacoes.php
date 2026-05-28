<?php

session_start();

require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

if (!isset($pdo) || !$pdo) {
    exit('Erro de conexão com o banco.');
}

$id = $_SESSION['USU_CODIGO'];

/* BUSCA USUÁRIO */

$stmt = $pdo->prepare("
    SELECT * FROM USUARIO
    WHERE USU_CODIGO = ?
");

$stmt->execute([$id]);

$usuario = $stmt->fetch();

/* BUSCA REDAÇÕES */

$stmt = $pdo->prepare("
    SELECT * FROM REDACAO
    WHERE RED_USU_CODIGO = ?
");

$stmt->execute([$id]);

$redacoes = $stmt->fetchAll();

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Minhas Redações</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<!-- TOPO -->

<div id="s1" class="a"></div>

<img src="assets/logo.png" id="logo" class="a">

<h1 id="tit1" class="a">Suas Redações</h1>

<img src="assets/perfil.png"
     id="perfil"
     class="a"
     alt="perfil"
     onclick="abrirperfil()">

<img src="assets/barra.png"
     id="barra"
     class="a"
     alt="menu"
     onclick="abrirmenu()">

<!-- MENU PERFIL -->

<nav id="menu_p" class="a">

    <h1 id="np">
        <?= $usuario['USU_NOME']; ?>
    </h1>

    <a href="logout.php" id="sair">
        Sair
    </a>

</nav>

<!-- MENU -->

<nav id="menu" class="a">

    <button id="b1" class="a" onclick="novaredacao()">
        Nova Redação
    </button>

    <button id="b2" class="a" onclick="redacoes()">
        Redações
    </button>

    <button id="b3" class="a" onclick="configuracoes()">
        Configurações
    </button>

</nav>

<!-- CONFIGURAÇÕES -->

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

<!-- REDAÇÕES -->

<div class="container-redacoes">

<?php if(count($redacoes) > 0): ?>

    <?php foreach($redacoes as $redacao): ?>

        <div class="card-redacao">

            <h1>
                <?= $redacao['RED_TEMA']; ?>
            </h1>

            <h3>Introdução</h3>

            <p>
                <?= $redacao['RED_INTRODUCAO']; ?>
            </p>

            <h3>Desenvolvimento</h3>

            <p>
                <?= $redacao['RED_DESENVOLVIMENTO']; ?>
            </p>

            <h3>Conclusão</h3>

            <p>
                <?= $redacao['RED_CONCLUSAO']; ?>
            </p>

        </div>

    <?php endforeach; ?>

<?php else: ?>

    <h2 style="margin-top:200px; text-align:center;">
        Nenhuma redação encontrada.
    </h2>

<?php endif; ?>

</div>

<script>

function abrirmenu(){

    let menu = document.getElementById("menu");
    let menu_p = document.getElementById("menu_p");

    if(menu.style.display === "none" || menu.style.display === ""){

        menu.style.display = "inline-block";
        menu_p.style.display = "none";

    }else{

        menu.style.display = "none";
    }
}

function abrirperfil(){

    let menu_p = document.getElementById("menu_p");
    let menu = document.getElementById("menu");

    if(menu_p.style.display === "none" || menu_p.style.display === ""){

        menu_p.style.display = "inline-block";
        menu.style.display = "none";

    }else{

        menu_p.style.display = "none";
    }
}

function novaredacao(){

    window.location.href = "novaredacao.php";
}

function redacoes(){

    window.location.href = "minhas_redacoes.php";
}

function configuracoes(){

    document.getElementById("configuracoes").style.display = "block";
}

function FecharConfiguracoes(){

    document.getElementById("configuracoes").style.display = "none";
}

</script>

</body>

</html>