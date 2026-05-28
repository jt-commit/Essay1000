<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['USU_CODIGO'])) {
    $_SESSION['erro'] = "Faça login para acessar o sistema.";

    header("Location: login.php");
    exit();
}