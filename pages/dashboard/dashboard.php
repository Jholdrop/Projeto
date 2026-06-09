<?php
session_start();
require_once "../../config/conexao.php";
if (!isset($_SESSION["funcionario_id"])) {
    header("Location: ../login/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Bodyfit</title>

  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

  <header>
    <h1>BODYFIT</h1>

    <div>
      <p>Funcionário: <?php echo $_SESSION["funcionario_nome"]; ?></p>
      <p>Cargo: <?php echo $_SESSION["funcionario_cargo"]; ?></p>

      <a href="../login/logout.php">Sair</a>
    </div>
  </header>

  <main>
    <h2>Painel Administrativo</h2>
    <p>Bem-vindo ao sistema administrativo da academia.</p>

    <section class="cards">

      <a href="/pages/usuarios/cadastro_usuarios.html" class="card">
        <h3>Cadastrar Usuário</h3>
        <p>Adicionar novos alunos ao sistema.</p>
      </a>

      <a href="/pages/usuarios/gerenciamento_usuarios.php" class="card">
        <h3>Gerenciamento de Usuários</h3>
        <p>Listar, editar e excluir alunos cadastrados.</p>
      </a>

      <a href="/pages/planos/controle_planos.php" class="card">
        <h3>Controle de Planos</h3>
        <p>Gerenciar planos da academia.</p>
      </a>

      <a href="/pages/bloqueios/controle_bloqueios.php" class="card">
        <h3>Controle de Bloqueios</h3>
        <p>Controlar alunos bloqueados.</p>
      </a>

    </section>
  </main>

</body>
</html>