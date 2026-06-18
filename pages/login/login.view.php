<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login do Funcionário - Bodyfit</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/style.css">
</head>
<body class="login-body">
<div class="login-wrapper">
<div class="login-brand-side" style="background-image: url('/assets/img/gym-bg.png');">
<div class="login-brand-overlay"></div>
<div class="login-brand-content">
<div class="login-logo-title">
<span class="logo-bold">BODY<span class="text-primary">FIT</span></span>
<span class="logo-sub">ACADEMIA</span>
</div>
<p class="login-slogan">Mais que uma academia,
<br>um
<span class="text-primary font-weight-bold">estilo de vida.</span></p>
</div>
<div class="decor-lines-top-left"></div>
</div>
<div class="login-form-side">
<div class="login-card-container">
<div class="login-icon-avatar">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
</svg>
</div>
<h1 class="login-title">Login do Funcionário</h1>
<p class="login-subtitle">Acesse o sistema administrativo</p>
<?php if (isset($_GET['erro'])): ?>
<div class="login-alert-error"> CPF ou senha incorretos. Tente novamente.
</div>
<?php endif; ?>
<form action="valida_login.php" method="POST" class="login-form">
<div class="form-group">
<label for="cpf">Usuário</label>
<div class="input-icon-group">
<span class="input-icon">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
</svg>
</span>
<input type="text" name="cpf" id="cpf" data-mask="cpf" maxlength="14" placeholder="Digite seu usuário" required autocomplete="off">
</div>
</div>
<div class="form-group input-group">
<label for="senha">Senha</label>
<div class="input-icon-group">
<span class="input-icon">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
</svg>
</span>
<input type="password" name="senha" id="senha" placeholder="Digite sua senha" required autocomplete="off">
<button type="button" class="toggle-password">👁</button>
</div>
</div>
<button type="submit" class="btn-login">ENTRAR</button>
</form>
<script src="/assets/js/main.js"></script>
</body>
</html>
