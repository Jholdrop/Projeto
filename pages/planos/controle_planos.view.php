<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Controle de Planos - Bodyfit</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="app-body">
<div class="app-layout">
<?php include "../includes/sidebar.php"; ?>
<div class="app-content-wrapper">
<?php include "../includes/header.php"; ?>
<main class="app-main-content">
<?php if (!empty($mensagem)): ?>
<div class="dashboard-panel full-width-panel">
<div class="panel-content">
<span class="status-badge
<?php echo $mensagem_classe;
?>"><?php echo $mensagem;
?>
</span>
</div>
</div>
<?php endif; ?>
<div class="dashboard-panel full-width-panel">
<div class="panel-header">
<h2>Novo plano</h2>
</div>
<div class="panel-content">
<form action="cadastro_plano.php" method="POST" class="plan-form">
<div class="form-group">
<label>Nome do plano</label>
<input type="text" name="nome" placeholder="Ex: Mensal" required autocomplete="off">
</div>
<div class="form-group">
<label>Valor</label>
<input type="number" name="valor" step="0.01" min="0" placeholder="Ex: 39.90" required autocomplete="off">
</div>
<div class="form-group">
<label>Opcoes de pagamento</label>
<input type="text" name="opcao_pagamentos" placeholder="Ex: Credito, Debito, Pix" required autocomplete="off">
</div>
<button type="submit" class="btn-primary-action">Cadastrar plano</button>
</form>
</div>
</div>
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
<th>Opcoes de Pagamento</th>
<th class="text-center">Acoes</th>
</tr>
</thead>
<tbody>
<?php if (empty($resultado)): ?>
<tr>
<td colspan="5" class="text-center text-dim py-8">Nenhum plano cadastrado no banco.</td>
</tr>
<?php else: ?>
<?php foreach ($resultado as $plano) {
?>
<tr>
<td>#<?php echo htmlspecialchars($plano["id"]);
?>
</td>
<td class="font-weight-medium text-primary"><?php echo htmlspecialchars($plano["nome"]);
?>
</td>
<td>R$
<?php echo number_format($plano["valor"], 2, ',', '.'); ?>
</td>
<td class="text-dim"><?php echo htmlspecialchars($plano["opcao_pagamentos"]);
?>
</td>
<td>
<div class="table-actions-group">
<a href="editar_plano.php?id=<?php echo $plano['id'];
?>" class="action-btn-edit" title="Editar plano">Editar</a>
<a href="excluir_plano.php?id=<?php echo $plano['id'];
?>" class="action-btn-delete" title="Excluir plano" onclick="return confirm('Deseja realmente excluir o plano
<?php echo addslashes($plano['nome']);
?>?');">Excluir</a>
</div>
</td>
</tr>
<?php }
?>
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
