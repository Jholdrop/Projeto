<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.html");
    exit;
}

require_once "../../config/conexao.php";

$sql = "
SELECT
    b.id,
    u.nome,
    b.data_bloqueio,
    b.status,
    b.motivo
FROM bloqueados b
INNER JOIN usuarios u
ON b.usuario_id = u.id
ORDER BY b.data_bloqueio DESC
";

$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Bloqueios</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<h1>Controle de Bloqueios</h1>

<a href="/pages/dashboard/dashboard.php">
    Voltar ao Dashboard
</a>

<table border="1">

    <thead>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Data do Bloqueio</th>
            <th>Status</th>
            <th>Motivo</th>
        </tr>
    </thead>

    <tbody>

    <?php foreach ($resultado as $bloqueio) { ?>

        <tr>
            <td><?php echo $bloqueio["id"]; ?></td>
            <td><?php echo $bloqueio["nome"]; ?></td>
            <td><?php echo $bloqueio["data_bloqueio"]; ?></td>
            <td><?php echo $bloqueio["status"]; ?></td>
            <td><?php echo $bloqueio["motivo"]; ?></td>
        </tr>

    <?php } ?>

    </tbody>

</table>

</body>
</html>