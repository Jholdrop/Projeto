<?php
session_start();
require_once "../../config/conexao.php";

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}

try {
    // Carregar todos os usuários do banco com seus respectivos planos (se houver relacionamento)
    $sql = "SELECT u.*, p.nome as plano_nome 
            FROM usuarios u 
            LEFT JOIN planos p ON u.plano_id = p.id 
            ORDER BY u.id DESC";
    $resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $resultado = [];
}

$page_active = 'gerenciamento';
$header_title = "Gerenciamento de usuários";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a> <span class="divider">></span> <span class="current">Gerenciamento de usuários</span></div>';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários - Bodyfit</title>
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
                    <div class="panel-header table-actions-header">
                        <!-- Barra de Pesquisa e Filtros -->
                        <div class="search-bar-container">
                            <span class="search-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                                </svg>
                            </span>
                            <input type="text" id="table-search" placeholder="Buscar aluno por nome, CPF ou plano..." autocomplete="off">
                        </div>

                        <!-- Botão de Cadastro Rápido -->
                        <a href="cadastro_usuarios.php" class="btn-primary-action">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Novo Aluno
                        </a>
                    </div>

                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="app-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>CPF</th>
                                        <th>E-mail</th>
                                        <th>Telefone</th>
                                        <th>CEP</th>
                                        <th>Número</th>
                                        <th>Plano</th>
                                        <th>Status</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($resultado)): ?>
                                        <tr>
                                            <td colspan="10" class="text-center text-dim py-8">Nenhum usuário cadastrado até o momento.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($resultado as $usuario) { 
                                            $status_class = strtolower($usuario["status"]) == 'inativo' ? 'badge-inativo' : 'badge-ativo';
                                            $status_label = strtolower($usuario["status"]) == 'inativo' ? 'Inativo' : 'Ativo';
                                            
                                            // Formatar CPF para exibição se não estiver formatado
                                            $raw_cpf = preg_replace('/\D/', '', $usuario["cpf"]);
                                            $cpf_formatado = $usuario["cpf"];
                                            if (strlen($raw_cpf) == 11) {
                                                $cpf_formatado = substr($raw_cpf, 0, 3) . '.' . substr($raw_cpf, 3, 3) . '.' . substr($raw_cpf, 6, 3) . '-' . substr($raw_cpf, 9, 2);
                                            }
                                        ?>
                                            <tr>
                                                <td>#<?php echo $usuario["id"]; ?></td>
                                                <td class="font-weight-medium"><?php echo $usuario["nome"]; ?></td>
                                                <td class="text-dim"><?php echo $cpf_formatado; ?></td>
                                                <td><?php echo $usuario["email"]; ?></td>
                                                <td><?php echo $usuario["telefone"]; ?></td>
                                                <td class="text-dim"><?php echo $usuario["cep"]; ?></td>
                                                <td><?php echo $usuario["numero"]; ?></td>
                                                <td>
                                                    <span class="plano-tag">
                                                        <?php echo !empty($usuario["plano_nome"]) ? $usuario["plano_nome"] : ($usuario["plano_id"] == 1 ? "Mensal" : ($usuario["plano_id"] == 2 ? "Trimestral" : "Anual")); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="status-badge <?php echo $status_class; ?>">
                                                        <?php echo $status_label; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="table-actions-group">
                                                        <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>" class="action-btn-edit" title="Editar Usuário">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487l1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 20.013a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                                            </svg>
                                                            Editar
                                                        </a>
                                                        <a href="excluir_usuario.php?id=<?php echo $usuario['id']; ?>" class="action-btn-delete" title="Excluir Usuário" onclick="return confirm('Deseja realmente excluir o aluno <?php echo addslashes($usuario['nome']); ?>?');">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                            Excluir
                                                        </a>
                                                    </div>
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
