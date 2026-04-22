<?php
$host = "localhost";
$dbname = "ESCOLA";
$user = "root";
$pass = "root";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,  $pass
    );
    
} catch (PDOException $e) {
    die("Erro na conexão com o banco: " . $e->getMessage());
}
?>