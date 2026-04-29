<?php
session_start();//usuario logado

if(!isset($_SESSION['USU_EMAIL'])){//caso o usuário não esteja logado em
header("Location: login.php");//sua conta, envia ele para a pagina de login.
exit;
}
?>