<?php
session_start();
require "banco.php";

// Se já estiver logado, manda direto pro index
if (isset($_SESSION['USU_EMAIL'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST['USU_EMAIL'];
    $senha = $_POST['USU_SENHA'];

    $stmt = $pdo->prepare("SELECT * FROM USUARIO WHERE USU_EMAIL = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['USU_SENHA'])) {

     $_SESSION['USU_CODIGO'] = $user['USU_CODIGO'];
     $_SESSION['USU_NOME']   = $user['USU_NOME'];
     $_SESSION['USU_EMAIL']  = $user['USU_EMAIL'];

     header("Location: index.php");
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
   <div id="s2" class= "a"></div>
   <div id="s3" class= "a"></div>

    <img src= "assets/logo.png" id="logo2" class= "a"></img><!--logo-->

   <div id="caixa" class="a">
   <form method="POST">
    <input type="email" name="USU_EMAIL" placeholder="Email" id="email" class="a">
    <input type="password" name="USU_SENHA" placeholder="Senha" id="senha" class="a">
    <button type="submit" class="a" id="entrar">Entrar</button>
    <p id="cadastro" class="a" onclick="register()">não tem uma conta? cadastre-se aqui</p>
   </form>

   <?php if (isset($_GET['erro'])): ?>
    <p style="color:red;">Email ou senha incorretos</p>
   <?php endif; ?>
    <script>
    
      function register(){
      window.location.href= "register.php";
      //cria o caminho de register//
      };

    </script>
   </div>
  </body>
</html>