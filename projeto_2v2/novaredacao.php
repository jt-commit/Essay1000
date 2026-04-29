<?php
require "redirecionar.php";//redireciona quem não estiver logado

session_start();//usuário logado
require "banco.php";//necessita de banco.php

$id = $_SESSION['USU_CODIGO'];

$stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE USU_CODIGO = ?");
$stmt->execute([$id]);//pega o nome do usuário

$usuario = $stmt->fetch();
?>

<!DOCTYPE html>

<html lang="pt-br">
    
  <head>

   <link rel="stylesheet" href="style.css">

  </head>

  <body>

     <div id="s1" class= "a"></div><!--decoração superior-->

 
     <img src= "assets/logo.png" id="logo" class= "a"></img><!--logo-->

      <img src= "assets/perfil.png" id="perfil" 
     onclick="abrirperfil()" alt="..." class="a"></img><!--perfil-->

     <img src= "assets/barra.png" id="barra" 
     onclick ="abrirmenu()" alt="..." class="a"> <!--barra-->

    <div id="caixa3" class="a"><!--caixa de informações-->
     
      <h1 id="criartema" class="a">Escreva seu Tema Abaixo<h1><!--texto-->
      <input type="text" placeholder="tema aqui..."
      class="a" id="tema"></input><!--tema-->
      <img src="assets/lapis.png" id="lapis" class="a"></img><!--lapis-->

    </div>

    <nav id="menu_p" class="a"><!--menu do perfil-->
      <h1 id="np" class=> <?= $usuario['USU_NOME']; ?></h1><!--nome do usuário-->
      <a href="logout.php" class="a" id="sair">sair</a><!--deslogar-->
    </nav>

    <nav id="menu" class="a"><!--menu aberto pela barra-->
     <button id="b1" class="a" onclick="novaredacao()"> Nova Redação </button>
     <!--abre novaredacao-->
     <button id="b2" class="a" onclick="redacoes()"> Redações </button>
     <!--abre redacoes-->
    </nav>

    <script>

     function abrirmenu(){
     //tira e coloca o none no display//
     let menu = document.getElementById("menu");
     if(menu.style.display === "none"){
     menu.style.display = "inline-block";
     menu_p.style.display = "none"
     //deixa visivel ao clique na barra//
     }else{
     menu.style.display = "none"
     //deixa invisivel ao clique na barra//
     }};

     function abrirperfil(){
     //tira o none do dispaly imposto no style por um clique//
     let menu_p = document.getElementById("menu_p");
     if(menu_p.style.display === "none"){
     menu_p.style.display = "inline-block";
     menu.style.display = "none"
     }else{
     //aplica o none caso esteja desabilitado por um clique//
     menu_p.style.display = "none";
     }};
   
     function novaredacao(){
      window.location.href= "novaredacao.php";
      //cria o caminho de novaredacao//
      };
     function redacoes(){
        window.location.href = "redacoes.php";
        //cria o caminho de redacoes//
      };

    </script>

 
  </body>


</html>