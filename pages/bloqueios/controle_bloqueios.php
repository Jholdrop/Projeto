<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}

require_once "../../config/conexao.php";

try {
    $usuarios_ativos = $conexao->query("SELECT id, nome FROM usuarios WHERE LOWER(status) = 'ativo' ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

    $sql = "
    SELECT
        b.id,
        b.usuario_id,
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
    $usuarios_ativos = [];
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
        <h2>Novo bloqueio</h2>
        </div>
        <div class="panel-content">
        <form action="bloqueios.php" method="POST" class="block-form">
        <input type="hidden" name="acao" value="bloquear">
        <div class="form-group">
        <label>Aluno</label>
        <select name="usuario_id" required>
                                    <option value="">Selecione um aluno ativo</option>
                                    <?php foreach ($usuarios_ativos as $usuario): ?>
                                        <option value="<?php echo $usuario["id"]; ?>"><?php echo htmlspecialchars($usuario["nome"]); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Motivo</label>
                                <input type="text" name="motivo" placeholder="Informe o motivo do bloqueio" required autocomplete="off">
                            </div>
                            <button type="submit" class="btn-primary-action">Bloquear aluno</button>
                        </form>
                    </div>
                </div>
                
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
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($resultado)): ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-dim py-8">Nenhum bloqueio registrado no banco.</td>
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
                                                <td>
                                                    <?php if (strtolower($bloqueio["status"]) == 'ativo'): ?>
                                                        <form action="bloqueios.php" method="POST" class="inline-action-form table-actions-group">
                                                            <input type="hidden" name="usuario_id" value="<?php echo $bloqueio['usuario_id']; ?>">
                                                            <input type="hidden" name="acao" value="desbloquear">
                                                            <button type="submit" class="action-btn-edit" onclick="return confirm('Deseja revogar este bloqueio?');">Revogar</button>
                                                        </form>
                                                    <?php else: ?>
                                                        <span class="text-dim">-</span>
                                                    <?php endif; ?>
                                                </td>
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
