<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.html");
    exit;
}

require_once "../../config/conexao.php";

$sql = "SELECT * FROM planos ORDER BY id";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Planos</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

    <h1>Controle de Planos</h1>

    <a href="/pages/dashboard/dashboard.php">Voltar ao Dashboard</a>

    <h2>Planos cadastrados</h2>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Opções de Pagamento</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($resultado as $plano) { ?>
                <tr>
                    <td><?php echo $plano["id"]; ?></td>
                    <td><?php echo $plano["nome"]; ?></td>
                    <td>R$ <?php echo $plano["valor"]; ?></td>
                    <td><?php echo $plano["opcao_pagamentos"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>