<?php
$nome_func = $_SESSION["funcionario_nome"] ?? "Administrador";
$cargo_func = $_SESSION["funcionario_cargo"] ?? "admin";
$email_func = strtolower(str_replace(' ', '', $nome_func)) . "@bodyfit.com";
?>
<header class="app-header">
    <div class="header-left">
        <?php if (isset($header_title)): ?>
            <h1 class="page-title"><?php echo $header_title; ?></h1>
        <?php endif; ?>
        <?php if (isset($header_subtitle)): ?>
            <p class="page-subtitle"><?php echo $header_subtitle; ?></p>
        <?php endif; ?>
    </div>
    
    <div class="header-right">
        <!-- Notificações -->
        <div class="notification-trigger">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>
            <span class="badge">3</span>
        </div>

        <!-- Perfil do Usuário -->
        <div class="user-profile-menu">
            <div class="profile-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </div>
            <div class="profile-info">
                <span class="user-name"><?php echo $nome_func; ?></span>
                <span class="user-email"><?php echo $email_func; ?></span>
            </div>
            <span class="profile-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </span>
        </div>
    </div>
</header>
