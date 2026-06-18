<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar Plano - Bodyfit</title>
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
<div class="dashboard-panel full-width-panel">
<div class="panel-header">
<h2>Editar plano</h2>
</div>
<div class="panel-content">
<form action="atualizar_plano.php" method="POST" class="plan-form">
<input type="hidden" name="id" value="<?php echo htmlspecialchars($plano["id"]);
?>">
<div class="form-group">
<label>Nome do plano</label>
<input type="text" name="nome" value="<?php echo htmlspecialchars($plano["nome"]);
?>" required autocomplete="off">
</div>
<div class="form-group">
<label>Valor</label>
<input type="number" name="valor" step="0.01" min="0" value="<?php echo htmlspecialchars($plano["valor"]);
?>" required autocomplete="off">
</div>
<div class="form-group">
<label>Opcoes de pagamento</label>
<input type="text" name="opcao_pagamentos" value="<?php echo htmlspecialchars($plano["opcao_pagamentos"]);
?>" required autocomplete="off">
</div>
<div class="table-actions-group">
<a href="controle_planos.php" class="btn-cancel">Cancelar</a>
<button type="submit" class="btn-primary-action">Salvar alteracoes</button>
</div>
</form>
</div>
</div>
</main>
</div>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
