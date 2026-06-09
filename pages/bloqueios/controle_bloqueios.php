<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}

require_once "../../config/conexao.php";

try {
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
    $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $resultado = [];
}

$page_active = 'bloqueios';
$header_title = "Controle de Bloqueios";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a> <span class="divider">></span> <span class="current">Controle de bloqueios</span></div>';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Bloqueios - Bodyfit</title>
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
                        <h2>Lista de alunos bloqueados</h2>
                    </div>

                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="app-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome do Aluno</th>
                                        <th>Data do Bloqueio</th>
                                        <th>Status do Bloqueio</th>
                                        <th>Motivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($resultado)): ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-dim py-8">Nenhum bloqueio registrado no banco.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($resultado as $bloqueio) { 
                                            $status_class = strtolower($bloqueio["status"]) == 'ativo' ? 'badge-inativo' : 'badge-ativo';
                                            $status_label = strtolower($bloqueio["status"]) == 'ativo' ? 'Bloqueio Ativo' : 'Revogado';
                                        ?>
                                            <tr>
                                                <td>#<?php echo $bloqueio["id"]; ?></td>
                                                <td class="font-weight-medium"><?php echo $bloqueio["nome"]; ?></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($bloqueio["data_bloqueio"])); ?></td>
                                                <td>
                                                    <span class="status-badge <?php echo $status_class; ?>">
                                                        <?php echo $status_label; ?>
                                                    </span>
                                                </td>
                                                <td class="text-dim"><?php echo $bloqueio["motivo"]; ?></td>
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