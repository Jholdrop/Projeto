<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}

require_once "../../config/conexao.php";

try {
    $sql = "SELECT * FROM planos ORDER BY id";
    $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $resultado = [];
}

$page_active = 'planos';
$header_title = "Controle de Planos";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a> <span class="divider">></span> <span class="current">Controle de planos</span></div>';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Planos - Bodyfit</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="app-body">

    <div class="app-layout">
        <!-- Sidebar Include -->
        <?php include "../includes/sidebar.php"; ?>

        <!-- Área de Conteúdo -->
        <div class="app-content-wrapper">
            <!-- Header Include -->
            <?php include "../includes/header.php"; ?>

            <main class="app-main-content">
                
                <div class="dashboard-panel full-width-panel">
                    <div class="panel-header">
                        <h2>Planos cadastrados</h2>
                    </div>

                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="app-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome do Plano</th>
                                        <th>Valor Mensal</th>
                                        <th>Opções de Pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($resultado)): ?>
                                        <tr>
                                            <td colspan="4" class="text-center text-dim py-8">Nenhum plano cadastrado no banco.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($resultado as $plano) { ?>
                                            <tr>
                                                <td>#<?php echo $plano["id"]; ?></td>
                                                <td class="font-weight-medium text-primary"><?php echo $plano["nome"]; ?></td>
                                                <td>R$ <?php echo number_format($plano["valor"], 2, ',', '.'); ?></td>
                                                <td class="text-dim"><?php echo $plano["opcao_pagamentos"]; ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="/assets/js/main.js"></script>
</body>
</html>