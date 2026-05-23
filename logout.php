<?php
session_start();//usuário logado
session_destroy();//desloga usuário
header("Location: login.php");//redireciona para o login
exit;
?>