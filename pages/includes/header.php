<?php
$nome_func = $_SESSION["funcionario_nome"] ?? "Administrador";
$cargo_func = $_SESSION["funcionario_cargo"] ?? "admin";
$email_func = strtolower(str_replace(' ', '', $nome_func)) . "@bodyfit.com";
?>
<header class="app-header">
<div class="header-left">
<?php if (isset($header_title)): ?>
<h1 class="page-title"><?php echo $header_title;
?>
</h1>
<?php endif; ?>
<?php if (isset($header_subtitle)): ?>
<p class="page-subtitle"><?php echo $header_subtitle;
?>
</p>
<?php endif; ?>
</div>
<div class="header-right">
<div class="user-profile-menu">
<div class="profile-info">
<span class="user-name"><?php echo $nome_func;
?>
</span>
<span class="user-email"><?php echo $email_func;
?>
</span>
</div>
<span class="profile-arrow">
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
<path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
</svg>
</span>
</div>
</div>
</header>
