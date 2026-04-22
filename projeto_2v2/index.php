<?php
session_start();
require "redirecionar.php";
require "banco.php";

$id = $_SESSION['USU_CODIGO'];
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
  
     <div id="s1" class= "a"></div><!--decoração superior-->
     <div id="s2" class= "a"></div>
     <div id="s3" class= "a"></div>

     <h1 id="ni" class="a">Seja Bem Vindo, <?= $usuario['USU_NOME']; ?></h1>

     <img src= "assets/logo.png" id="logo2" class= "a"></img><!--logo-->
   
      <div id="caixa" class="a"><!--caixa de botões-->

       <button id="nr" class="a" onclick="novaredacao()"
       > Nova Redação </button> <!--abre novaredacao-->  

       <button id="r" class="a" onclick="redacoes()"
       > Redações </button> <!--abre redacoes-->

       <button id="c" class="a" onclick="configuracoes()"
       > Configurações </button> <!--abre configurações-->

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

      </script>

    </body>

  </html>