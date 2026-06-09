<?php
if (!isset($page_active)) {
    $page_active = '';
}
?>
<aside class="app-sidebar">
    <div class="sidebar-brand">
        <span class="logo-bold">BODY<span class="text-primary">FIT</span></span>
        <span class="logo-sub">ACADEMIA</span>
    </div>

    <nav class="sidebar-nav">
        <a href="/pages/dashboard/dashboard.php" class="nav-link <?php echo $page_active == 'dashboard' ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21.75h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21.75h8.25" />
                </svg>
            </span>
            <div class="nav-text">
                <span class="nav-title">Dashboard</span>
                <span class="nav-subtitle">Administrativo</span>
            </div>
        </a>

        <a href="/pages/usuarios/cadastro_usuarios.php" class="nav-link <?php echo $page_active == 'cadastro' ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </span>
            <div class="nav-text">
                <span class="nav-title">Cadastro de usuários</span>
            </div>
        </a>

        <a href="/pages/usuarios/gerenciamento_usuarios.php" class="nav-link <?php echo $page_active == 'gerenciamento' ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766v-.109A12.318 12.318 0 0 1 8.624 18c2.331 0 4.512.645 6.374 1.766Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 5.25a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM18.75 12a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </span>
            <div class="nav-text">
                <span class="nav-title">Gerenciamento de usuários</span>
            </div>
        </a>

        <a href="/pages/planos/controle_planos.php" class="nav-link <?php echo $page_active == 'planos' ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
            </span>
            <div class="nav-text">
                <span class="nav-title">Controle de planos</span>
            </div>
        </a>

        <a href="/pages/bloqueios/controle_bloqueios.php" class="nav-link <?php echo $page_active == 'bloqueios' ? 'active' : ''; ?>">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                </svg>
            </span>
            <div class="nav-text">
                <span class="nav-title">Controle de bloqueios</span>
            </div>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="/pages/login/logout.php" class="nav-link logout-link">
            <span class="nav-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
            </span>
            <div class="nav-text">
                <span class="nav-title">Sair do sistema</span>
            </div>
        </a>
    </div>
</aside>
