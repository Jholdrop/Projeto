<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro de Usuários - Bodyfit</title>
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
<form action="cadastro.php" method="POST" enctype="multipart/form-data" class="gym-form-container">
<div class="form-main-columns">
<div class="form-left-column">
<div class="form-section-card">
<div class="section-card-header">
<span class="section-icon text-primary">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
</svg>
</span>
<h3>Dados pessoais</h3>
</div>
<div class="section-card-body">
<div class="form-grid">
<div class="grid-col-8">
<div class="form-group">
<label>Nome completo
<span class="required">*</span></label>
<input type="text" name="nome" placeholder="Digite o nome completo" required autocomplete="off">
</div>
</div>
<div class="grid-col-4">
<div class="form-group">
<label>Data de nascimento
<span class="required">*</span></label>
<div class="input-date-wrapper">
<input type="date" name="data_nascimento" required>
</div>
</div>
</div>
<div class="grid-col-3">
<div class="form-group">
<label>CPF
<span class="required">*</span></label>
<input type="text" name="cpf" data-mask="cpf" maxlength="14" placeholder="000.000.000-00" required autocomplete="off">
</div>
</div>
<div class="grid-col-6">
<div class="form-group">
<label>E-mail
<span class="required">*</span></label>
<input type="email" name="email" placeholder="exemplo@email.com" required autocomplete="off">
</div>
</div>
<div class="grid-col-3">
<div class="form-group">
<label>Telefone
<span class="required">*</span></label>
<div class="input-whatsapp-group">
<input type="text" name="telefone" data-mask="phone" maxlength="15" placeholder="(00) 00000-0000" required autocomplete="off">
<span class="whatsapp-icon">
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" class="w-4 h-4"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
</span>
</div>
</div>
</div>
<div class="grid-col-4">
<div class="form-group">
<label>Número
<span class="required">*</span></label>
<input type="text" name="numero" placeholder="123" required autocomplete="off">
</div>
</div>
<div class="grid-col-4">
<div class="form-group">
<label>Cidade
<span class="required">*</span></label>
<input type="text" name="cidade" placeholder="Digite a cidade" required autocomplete="off">
</div>
</div>
<div class="grid-col-4">
<div class="form-group">
<label>Estado
<span class="required">*</span></label>
<select name="estado" required>
<option value="">Selecione</option>
<option value="SP">São Paulo</option>
<option value="RJ">Rio de Janeiro</option>
<option value="MG">Minas Gerais</option>
<option value="PR">Paraná</option>
<option value="SC">Santa Catarina</option>
<option value="RS">Rio Grande do Sul</option>
<option value="BA">Bahia</option>
<option value="DF">Distrito Federal</option>
</select>
</div>
</div>
<div class="grid-col-4">
<div class="form-group">
<label>CEP
<span class="required">*</span></label>
<input type="text" name="cep" data-mask="cep" maxlength="9" placeholder="00000-000" required autocomplete="off">
</div>
</div>
</div>
</div>
</div>
<div class="form-actions-bar">
<a href="../dashboard/dashboard.php" class="btn-cancel">Cancelar</a>
<button type="submit" class="btn-submit">
Salvar usu&aacute;rio
</button>
</div>
</div>
<div class="form-right-column">
<div class="form-section-card side-panel-card">
<div class="section-card-header">
<span class="section-icon text-primary">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
</svg>
</span>
<h3>Foto do usuário</h3>
</div>
<div class="section-card-body side-photo-body">
<div class="photo-upload-container">
<div class="photo-preview-circle" id="photo-area">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-muted">
<path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
</svg>
</div>
<p class="photo-info-title">Clique para adicionar uma foto</p>
<p class="photo-info-desc">Formatos permitidos: JPG, PNG
<br> Tamanho máximo: 2MB</p>
<input type="file" name="foto_usuario" id="foto-input" accept="image/*" style="display: none;">
<button type="button" class="btn-select-photo" onclick="document.getElementById('foto-input').click();">Selecionar imagem</button>
</div>
</div>
</div>
<div class="form-section-card side-panel-card">
<div class="section-card-header">
<span class="section-icon text-primary">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
</svg>
</span>
<h3>Informações adicionais</h3>
</div>
<div class="section-card-body">
<div class="form-group">
<label>Plano
<span class="required">*</span></label>
<select name="plano_id" required>
<option value="">Selecione o plano</option>
<?php foreach ($planos as $plano): ?>
<option value="<?php echo $plano['id'];
?>"><?php echo $plano['nome'];
?>
</option>
<?php endforeach; ?>
</select>
</div>
<div class="form-group">
<label>Data de início
<span class="required">*</span></label>
<div class="input-date-wrapper">
<input type="date" name="data_inicio" required value="<?php echo date('Y-m-d');
?>">
</div>
</div>
<div class="form-group">
<label>Status</label>
<select name="status" class="status-select-active">
<option value="ativo" selected>Ativo</option>
<option value="inativo">Inativo</option>
</select>
</div>
<div class="form-group">
<label>Observações</label>
<textarea name="observacoes" placeholder="Observações opcionais sobre o usuário" maxlength="200" id="obs-textarea" oninput="document.getElementById('char-counter').textContent = this.value.length + '/200'"></textarea>
<span class="textarea-counter" id="char-counter">0/200</span>
</div>
</div>
</div>
</div>
</div>
</form>
</main>
</div>
</div>
<script src="/assets/js/main.js"></script>
</body>
</html>
