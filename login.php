<?php
session_start();// usuário logado
require "db.php";//necessita de conexão com o banco

// Se já estiver logado, manda direto pro index
if (isset($_SESSION['USU_EMAIL'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {//se o metódo for post

    $email = $_POST['USU_EMAIL'];//pega email
    $senha = $_POST['USU_SENHA'];//pega senha
    
    if (!$pdo) {
    exit('Erro de conexão com o banco.');
}

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
   <header>
  <a class="header-brand" href="#" >
    <span id="header-brand-name">Essay<span>1000</span></span>
  </a>
</header>

 <img src= "assets/logo.png" id="logo2" ></img><!--logo-->


   
   <div id="caixa" >
   <form method="POST"><!--caso o metódo seja post-->

   <div class="input-wrap">
  <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
    <rect x="2" y="4" width="20" height="16" rx="3"/>
    <path d="M2 7l10 7 10-7"/>
  </svg>
  <input type="email" name="USU_EMAIL" placeholder="Email" id="email">
</div>

<div class="input-wrap">
  <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
    <rect x="5" y="11" width="14" height="10" rx="2"/>
    <path d="M8 11V7a4 4 0 018 0v4"/>
  </svg>
  <input type="password" name="USU_SENHA" placeholder="Senha" id="senha">
</div>

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