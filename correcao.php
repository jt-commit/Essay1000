<?php
session_start();
require 'auth.php';
require_once __DIR__ . '/db.php';

if (!isset($_GET['id'])) {
    exit("ID da redação não enviado.");
}

$id = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM REDACAO
    WHERE RED_CODIGO = ?
");

$stmt->execute([$id])

$redacao = $stmt->fetch();

if (!$redacao) {
    exit("Redação não encontrada.");
}

$texto = "

Tema:
{$redacao['RED_TEMA']}

Introdução:
{$redacao['RED_INTRODUCAO']}

Desenvolvimento:
{$redacao['RED_DESENVOLVIMENTO']}

Conclusão:
{$redacao['RED_CONCLUSAO']}

";

/* SUA API KEY */
$apiKey = "AIzaSyC_nWIcVQzu6q3-WfgqyXuwO5IksBZSews";

$dados = [

    "contents" => [

        [

            "parts" => [

                [

                    "text" => "

Corrija esta redação do ENEM.

Retorne:
- nota
- erros
- sugestões
- pontos fortes

Redação:

$texto

"

                ]

            ]

        ]

    ]

];

$ch = curl_init();

curl_setopt(
    $ch,
    CURLOPT_URL,
    "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=$apiKey"
);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_POST, true);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json"
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));

$resposta = curl_exec($ch);

curl_close($ch);

$resultado = json_decode($resposta, true);

/* MOSTRA ERRO DA API */
if(isset($resultado['error'])){

    echo "<pre>";
    print_r($resultado);
    echo "</pre>";

    exit();
}

/* PEGA RESPOSTA DA IA */
$correcao =
$resultado['candidates'][0]['content']['parts'][0]['text'];

/* SALVA CORREÇÃO NO BANCO */
$stmt = $pdo->prepare("
    INSERT INTO CORRECAO
    (
        COR_RED_CODIGO,
        COR_TEXTO
    )

    VALUES (?, ?)
");

$stmt->execute([

    $id,

    $correcao

]);

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Correção da Redação</title>

<style>

body{
    font-family: Arial;
    background-color: #f5f5f5;
    padding: 40px;
}

.caixa{
    background-color: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
}

h1{
    color: green;
}

</style>

</head>

<body>

<div class="caixa">

<h1>Correção da IA</h1>

<hr>

<?php echo nl2br($correcao); ?>

</div>

</body>

</html>