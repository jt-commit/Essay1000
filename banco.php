<?php
$host = "localhost";//conexão
$dbname = "ESCOLA";//nome do banco
$user = "root";//usuário do banco
$pass = "root";//senha do banco

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,  $pass
    );//cria um padrão
    
} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}//envia caso haja erro no banco
?>