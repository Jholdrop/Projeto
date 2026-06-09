<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel Inicial - Bodyfit</title>

  <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>

  <header>
    <div class="logo">
      BODYFIT
    </div>

    <div class="topo-direita">
      <p class="funcionario">
        <?php echo $_SESSION["funcionario_nome"]; ?>
      </p>

      <a href="/pages/login/logout.php" class="sair">
        Sair
      </a>
    </div>
  </header>

  <main class="container">

    <section class="titulo">
      <h1>Painel Administrativo</h1>

      <p>
        Bem-vindo,
        <strong><?php echo $_SESSION["funcionario_nome"]; ?></strong>
        (<?php echo $_SESSION["funcionario_cargo"]; ?>)
      </p>
    </section>

    <section class="cards">

      <a href="/pages/usuarios/cadastro_usuarios.html" class="card">
        <div class="icone">👤</div>

        <h2>Cadastrar Aluno</h2>

        <p>
          Adicione novos alunos ao sistema da academia.
        </p>
      </a>

      <a href="/pages/usuarios/gerenciamento_usuarios.php" class="card">
        <div class="icone">📋</div>

        <h2>Gerenciar Alunos</h2>

        <p>
          Visualize, edite e exclua alunos cadastrados.
        </p>
      </a>

      <a href="/pages/planos/controle_planos.php" class="card">
        <div class="icone">💳</div>

        <h2>Controle de Planos</h2>

        <p>
          Cadastre e altere planos da academia.
        </p>
      </a>

      <a href="/pages/bloqueios/controle_bloqueios.php" class="card">
        <div class="icone">🚫</div>

        <h2>Controle de Bloqueios</h2>

        <p>
          Gerencie alunos bloqueados.
        </p>
      </a>

    </section>

  </main>

  <footer>
    <p>
      © 2026 Bodyfit Academia - Sistema Administrativo
    </p>
  </footer>

</body>
</html>