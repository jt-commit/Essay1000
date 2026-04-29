<?php
require "redirecionar.php";//redireciona quem não está logado

session_start();// usuario logado
require "banco.php";// necessita de banco.php

$id = $_SESSION['USU_CODIGO'];

$stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE USU_CODIGO = ?");
$stmt->execute([$id]);// pega a informação do nome do usuário

$usuario = $stmt->fetch();
?>

<!DOCTYPE html>

<html lang="pt-br">
   
 <head>

 <link rel = "stylesheet" href="style.css">

 </head>

 <body>

 <div id="s1" class= "a"></div><!--decoração superior-->

 <img src= "assets/logo.png" id="logo" class= "a"></img><!--logo-->
 <h1 id="tit1" class= "a"> Suas Redações </h1><!--titulo-->

 <img src= "assets/perfil.png" id="perfil"
  onclick = "abrirperfil()" class="a" alt="..."></img><!--perfil-->

  <img src= "assets/barra.png" id="barra" 
  onclick ="abrirmenu()" alt="..." class="a"></img> <!--barra-->

   <nav id="menu_p" class="a"><!--menu do perfil-->

      <h1 id="np" class=> <?= $usuario['USU_NOME']; ?></h1><!--nome do usuário-->

      <a href="logout.php" class="a" id="sair">sair</a><!--desconecta da conta-->

   </nav>

   <nav id="menu" class="a"> <!--menu da barra-->

    <button id="b1" class="a" onclick="novaredacao()"> Nova Redação </button>
    <!--abre novaredacao-->

    <button id="b2" class="a" onclick="redacoes()"> Redações </button>
    <!--abre redacoes-->

   </nav>
 <script>

 function abrirmenu(){
    //tira o none do dispaly imposto no style por um clique//
    let menu = document.getElementById("menu");
    if(menu.style.display === "none"){
    menu.style.display = "inline-block";
    menu_p.stye.display = "none";
    }else{
    //aplica o none caso esteja desabilitado por um clique//
    menu.style.display = "none";
    }};
 function abrirperfil(){
    //tira e adiciona o none//
    let menu_p = document.getElementById("menu_p");
    if(menu_p.style.display === "none"){
    menu_p.style.display = "inline-block";
    menu.style.display = "none";
    }else{
    //aplica o none caso esteja desabilitado por um clique//
    menu_p.style.display = "none";
   }};
 function novaredacao(){
      //cria o caminho de novaredacao//
      window.location.href= "novaredacao.php";
   };
 function redacoes(){
      //cria o caminho de redacoes//
      window.location.href = "redacoes.php";
   };

</script>

 </body>
</html>