<?php
session_start();// usuário logado
require "banco.php";//necessita de banco.php

// Se já estiver logado, manda direto pro index
if (isset($_SESSION['USU_EMAIL'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {//se o metódo for post

    $email = $_POST['USU_EMAIL'];//pega email
    $senha = $_POST['USU_SENHA'];//pega senha

    $stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE USU_EMAIL = ?");
    $stmt->execute([$email]);//confere e executa o
    $user = $stmt->fetch();//   email e a senha

    if ($user && password_verify($senha, $user['USU_SENHA'])) {
    //recupera dados do registro
     $_SESSION['USU_CODIGO'] = $user['USU_CODIGO'];//senha
     $_SESSION['USU_NOME']   = $user['USU_NOME'];//nome
     $_SESSION['USU_EMAIL']  = $user['USU_EMAIL'];//email

     header("Location: index.php");// envia para o index
     exit;
    }
  }
?>

<!DOCTYPE html>

 <html lang="pt-br">
  
  <head>

    <link rel="stylesheet" href="style.css">

  </head>
  <body>
    <!--decoração superior-->
   <div id="s1" class= "a"></div>

    <img src= "assets/logo.png" id="logo2" class= "a"></img><!--logo-->

   <div id="caixa" class="a">
   <form method="POST"><!--caso o metódo seja post-->

    <input type="email" name="USU_EMAIL" placeholder="Email"
     id="email" class="a"><!--email-->

    <input type="password" name="USU_SENHA" placeholder="Senha"
     id="senha" class="a"><!--senha-->

    <button type="submit" class="a" id="entrar"
    >Entrar</button><!--entrar-->

    <p id="cadastro" class="a" onclick="register()"
    >não tem uma conta? cadastre-se aqui</p><!--cadastro/link-->

   </form>

   <?php if (isset($_GET['erro'])): ?>
    <p style="color:red;">Email ou senha incorretos</p>
   <?php endif; ?><!--envia caso esteja errado o login-->

    <script>
    
      function register(){
      window.location.href= "register.php";
      //cria o caminho de register//
      };

    </script>
   </div>
  </body>
</html>