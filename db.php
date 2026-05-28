<?php
// ...existing code...
$dbname = 'ESCOLA'; // ajuste
$user   = 'root';
$pass   = ''; // ajuste se tiver senha

$host = '127.0.0.1';
$port = 3308;
$charset = 'utf8mb4';

if (!class_exists('PDO')) {
    echo "Erro: a extensão PDO não está habilitada no PHP. Ative PDO no php.ini e reinicie o servidor.";
    exit;
}

$pdo = null;
$lastException = null;

try {
    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset={$charset}";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_TIMEOUT => 5,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    $lastException = $e;
}

if (!$pdo) {
    echo "Erro na conexão com o banco: " . ($lastException ? $lastException->getMessage() : 'falha desconhecida') . "<br>";
    echo "Ações: 1) Inicie MySQL no XAMPP; 2) Verifique porta (3308); 3) Troque para 127.0.0.1; 4) Verifique firewall.";
    exit;
}

// ...existing code...
?>