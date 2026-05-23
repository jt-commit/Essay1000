<?php
session_start();//usuário logado
require "redirecionar.php";//redireciona para o login caso não esteja logado
require "banco.php";//necessita de banco.php

$id = $_SESSION['USU_CODIGO'];//recupera dados do registro
$stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE USU_CODIGO = ?");
$stmt->execute([$id]);
$usuario = $stmt->fetch();
?>

<!DOCTYPE html>

  <html lang="pt-br">

    <head>
 
     <link rel= "stylesheet" href="style.css">
     <!-- guia o style para o index -->

    </head>
    <body>

      <nav id="menu_p" class="a"><!--menu do perfil-->

       <h1 id="np" class=> <?= $usuario['USU_NOME']; ?></h1><!--nome do usuário-->

       <a href="logout.php" class="a" id="sair">sair</a><!--desconecta da conta-->

      </nav>  

     <div id="s1" class= "a"></div><!--decoração superior-->
      
      <img src= "assets/perfil.png" id="perfil2" 
       onclick="abrirperfil()" alt="..." class="a"><!--perfil-->
   
      <div id="caixa4" class="a"><!--caixa de botões-->
       
       <button id="nr" class="a" onclick="novaredacao()"
       > Nova Redação </button> <!--abre novaredacao-->  

       <button id="r" class="a" onclick="redacoes()"
       > Redações </button> <!--abre redacoes-->

       <button id="c" class="a" onclick="configuracoes()"
       > Configurações </button> <!--abre configurações-->
       
       <div id="verde" class="a circulo"></div>
       <div id="azul" class="a circulo"></div>
       <div id="vermelho" class="a circulo"></div>
      </div>

       <div id="configuracoes" class="a"><!--quadro de configurações-->
       
       <button id="fechar" class="a" onclick="FecharConfiguracoes()"> X </button>
       <h1 id="tit2" class="a"> Configurações </h1>
       <p id="mensagem" class="a">Não há configurações no momento</p>

       </div>
      
      <script>

       function novaredacao(){
       window.location.href= "novaredacao.php";
       //cria o caminho de novaredacao//
       };
       function redacoes(){
         window.location.href = "redacoes.php";
         //cria o caminho de redacoes//
       };
        function configuracoes(){//revela configurações//
          document.getElementById("configuracoes").style.display = "block"
       };
        function FecharConfiguracoes(){//oculta configurações//
          document.getElementById("configuracoes").style.display = "none"
        };

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
      </script>

    </body>

  </html>