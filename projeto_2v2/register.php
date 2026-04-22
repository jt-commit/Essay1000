<?php
$erro = "";
if(isset($_GET['erro'])){
  $erro = $_GET['erro'];
}
require "banco.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['USU_NOME'];
    $email = $_POST['USU_EMAIL'];
    $senha = password_hash($_POST['USU_SENHA'], PASSWORD_DEFAULT);
    
    //verifica se conta ja existe
    $check = $pdo->prepare("SELECT * FROM USUARIO WHERE USU_EMAIL = ?");
    $check->execute([$email]);
    if($check->rowCount() > 0){
      //email já existe
      header("Location:register.php?erro=email");
      exit;
    }
    //insere normalmente
    $stmt = $pdo->prepare("INSERT INTO USUARIO (USU_NOME, USU_EMAIL, USU_SENHA) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha]);

    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>

<html lang="pt-br">

  <head>

   <link rel= "stylesheet" href="style.css">

  </head>

 <body>

  <!--decoração superior-->
  <div id="s1" class= "a"></div>
  <div id="s2" class= "a"></div>
  <div id="s3" class= "a"></div>

  <img src="assets/voltar.png" id="vr" class="a"
  onclick="login()"></img><!--botão de volta-->

  <img src= "assets/logo.png" 
  id="logo2" class= "a"></img> <!--logo central-->

  <div id= "caixa2" class="a"><!--caixa de dados-->

   <?php if($erro === "email"): ?>
    <p class="a" id="EC"> Esse usuário já está cadastrado </p>
   <?php endif; ?>
    
  <form method="POST">

   <input type = "text" name="USU_NOME"
   placeholder = "Digite um apelido" id= "nome" class="a"></input><!--nome-->

   <input type = "email" name="USU_EMAIL"
   placeholder = "Digite seu E-mail" id= "email2" class="a"></input><!--email-->

   <input type = "password" name="USU_SENHA"
   placeholder = "Digite uma senha" id= "senha2" class="a"></input><!--senha-->
   
   <button id="registrar" class="a" type="submit"
   > Cadastrar </button><!--cadastrar-->

   </form>

    <script>
     function login(){
      window.location.href= "login.php";
      //cria o caminho de login//
      };
    </script>
 </body>

</html>