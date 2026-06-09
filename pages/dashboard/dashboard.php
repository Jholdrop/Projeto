<?php
session_start();
require_once "../../config/conexao.php";

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: ../login/login.php");
    exit;
}

// Contagens dinâmicas
try {
    $db_total_usuarios = $conexao->query("SELECT COUNT(*) FROM usuarios WHERE status = 'ativo'")->fetchColumn();
    $db_novos_usuarios = $conexao->query("SELECT COUNT(*) FROM usuarios WHERE criado_em >= date_trunc('month', CURRENT_DATE)")->fetchColumn();
    $db_total_planos = $conexao->query("SELECT COUNT(*) FROM planos")->fetchColumn();
    $db_total_bloqueados = $conexao->query("SELECT COUNT(*) FROM bloqueados WHERE status = 'ativo'")->fetchColumn();
} catch (Exception $e) {
    $db_total_usuarios = 0;
    $db_novos_usuarios = 0;
    $db_total_planos = 0;
    $db_total_bloqueados = 0;
}

$total_usuarios = $db_total_usuarios > 0 ? $db_total_usuarios : 248;
$novos_usuarios = $db_novos_usuarios > 0 ? $db_novos_usuarios : 35;
$total_planos = $db_total_planos > 0 ? $db_total_planos : 198;
$total_bloqueados = $db_total_bloqueados > 0 ? $db_total_bloqueados : 12;

$page_active = 'dashboard';
$header_title = "Olá, " . ($_SESSION["funcionario_nome"] ?? "Administrador") . "! 👋";
$header_subtitle = "Bem-vindo ao sistema administrativo da Bodyfit.";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bodyfit</title>
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
                <!-- Cards de Estatísticas -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766v-.109A12.318 12.318 0 0 1 8.624 18c2.331 0 4.512.645 6.374 1.766Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15 5.25a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM18.75 12a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                        </div>
                        <div class="stat-info">
                            <span class="stat-label">Usuários ativos</span>
                            <span class="stat-value"><?php echo $total_usuarios; ?></span>
                            <span class="stat-trend trend-up">+12% <span class="trend-text">em relação ao mês anterior</span></span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                        </div>
                        <div class="stat-info">
                            <span class="stat-label">Novos usuários (mês)</span>
                            <span class="stat-value"><?php echo $novos_usuarios; ?></span>
                            <span class="stat-trend trend-up">+8% <span class="trend-text">em relação ao mês anterior</span></span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v5.625c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 3 18.75v-5.625ZM13.5 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v10.125c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 13.5 18.75V8.625ZM8.25 10.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v7.875c0 .621-.504 1.125-1.125 1.125h-2.25A1.125 1.125 0 0 1 8.25 18.75v-7.875Z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 3H12V6H9V3Z" />
                            </svg>
                        </div>
                        <div class="stat-info">
                            <span class="stat-label">Planos ativos</span>
                            <span class="stat-value"><?php echo $total_planos; ?></span>
                            <span class="stat-trend trend-up">+6% <span class="trend-text">em relação ao mês anterior</span></span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                        </div>
                        <div class="stat-info">
                            <span class="stat-label">Bloqueios ativos</span>
                            <span class="stat-value"><?php echo $total_bloqueados; ?></span>
                            <span class="stat-trend trend-down">-3% <span class="trend-text">em relação ao mês anterior</span></span>
                        </div>
                    </div>
                </div>

                <!-- Painel de Gráfico e Ações Rápidas -->
                <div class="dashboard-grid">
                    <!-- Painel do Gráfico -->
                    <div class="dashboard-panel chart-panel">
                        <div class="panel-header">
                            <div class="panel-title-group">
                                <span class="panel-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                                    </svg>
                                </span>
                                <h2>Resumo geral</h2>
                            </div>
                            <div class="panel-actions">
                                <select class="panel-select">
                                    <option>Últimos 7 meses</option>
                                    <option>Últimos 12 meses</option>
                                </select>
                            </div>
                        </div>
                        <div class="panel-content chart-container">
                            <canvas id="dashboard-chart"></canvas>
                        </div>
                    </div>

                    <!-- Painel de Ações Rápidas -->
                    <div class="dashboard-panel quick-actions-panel">
                        <div class="panel-header">
                            <div class="panel-title-group">
                                <span class="panel-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                                    </svg>
                                </span>
                                <h2>Ações rápidas</h2>
                            </div>
                        </div>
                        <div class="panel-content quick-actions-list">
                            <a href="/pages/usuarios/cadastro_usuarios.php" class="action-item">
                                <div class="action-left">
                                    <div class="action-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                        </svg>
                                    </div>
                                    <div class="action-info">
                                        <span class="action-title">Cadastrar novo usuário</span>
                                        <span class="action-desc">Adicione um novo usuário ao sistema</span>
                                    </div>
                                </div>
                                <span class="action-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </a>

                            <a href="/pages/usuarios/gerenciamento_usuarios.php" class="action-item">
                                <div class="action-left">
                                    <div class="action-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>
                                    <div class="action-info">
                                        <span class="action-title">Gerenciar usuários</span>
                                        <span class="action-desc">Visualize e edite usuários cadastrados</span>
                                    </div>
                                </div>
                                <span class="action-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </a>

                            <a href="/pages/planos/controle_planos.php" class="action-item">
                                <div class="action-left">
                                    <div class="action-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                    </div>
                                    <div class="action-info">
                                        <span class="action-title">Gerenciar planos</span>
                                        <span class="action-desc">Crie e edite planos da academia</span>
                                    </div>
                                </div>
                                <span class="action-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </a>

                            <a href="/pages/bloqueios/controle_bloqueios.php" class="action-item">
                                <div class="action-left">
                                    <div class="action-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                        </svg>
                                    </div>
                                    <div class="action-info">
                                        <span class="action-title">Ver bloqueios ativos</span>
                                        <span class="action-desc">Gerencie bloqueios de usuários</span>
                                    </div>
                                </div>
                                <span class="action-arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tabela de Atividades Recentes -->
                <div class="dashboard-panel full-width-panel">
                    <div class="panel-header">
                        <div class="panel-title-group">
                            <h2>Atividades recentes</h2>
                        </div>
                    </div>
                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="app-table">
                                <thead>
                                    <tr>
                                        <th>Ação</th>
                                        <th>Usuário</th>
                                        <th>Detalhes</th>
                                        <th>Data/Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="table-action-cell">
                                                <span class="action-cell-icon icon-user-add">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                    </svg>
                                                </span>
                                                Novo usuário cadastrado
                                            </div>
                                        </td>
                                        <td>Juliana Silva</td>
                                        <td class="text-dim">Usuário juliana.silva@email.com cadastrado</td>
                                        <td>20/05/2024 14:32</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-action-cell">
                                                <span class="action-cell-icon icon-plan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </span>
                                                Plano criado
                                            </div>
                                        </td>
                                        <td>Administrador</td>
                                        <td class="text-dim">Plano "Plano Gold" criado</td>
                                        <td>20/05/2024 11:15</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-action-cell">
                                                <span class="action-cell-icon icon-lock">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                                    </svg>
                                                </span>
                                                Usuário bloqueado
                                            </div>
                                        </td>
                                        <td>Carlos Pereira</td>
                                        <td class="text-dim">Bloqueado por inadimplência</td>
                                        <td>19/05/2024 16:45</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-action-cell">
                                                <span class="action-cell-icon icon-plan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                                    </svg>
                                                </span>
                                                Plano atualizado
                                            </div>
                                        </td>
                                        <td>Administrador</td>
                                        <td class="text-dim">Plano "Plano Silver" atualizado</td>
                                        <td>19/05/2024 10:22</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="table-action-cell">
                                                <span class="action-cell-icon icon-user-edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 20.013a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                    </svg>
                                                </span>
                                                Usuário editado
                                            </div>
                                        </td>
                                        <td>Mariana Costa</td>
                                        <td class="text-dim">Dados do usuário atualizados</td>
                                        <td>18/05/2024 09:30</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-footer-btn-wrapper">
                            <a href="#" class="btn-table-action">Ver todas as atividades</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="/assets/js/main.js"></script>
</body>
</html>