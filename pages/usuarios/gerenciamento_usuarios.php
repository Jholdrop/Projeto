<?php 
require_once "../../config/conexao.php";

$sql = "SELECT * FROM usuarios";
$resultado = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
</head>
<body>
    <h1>Gerenciamento de usuários</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Plano</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
        <?php foreach ($resultado as $usuario) { ?>
            <tr>
                <td><?php echo $usuario["id"]; ?></td>
                <td><?php echo $usuario["nome"]; ?></td>
                <td><?php echo $usuario["cpf"]; ?></td>
                <td><?php echo $usuario["email"]; ?></td>
                <td><?php echo $usuario["telefone"]; ?></td>
                <td><?php echo $usuario["endereco"]; ?></td>
                <td><?php echo $usuario["plano_id"]; ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?php echo $usuario['id'];?>">
                Editar
                    </a>
                    <td>
                    <a href="editar_usuario.php?id=<?php echo $usuario['id'];?>">
                Excluir
                    </a>
                </td>
            </tr>
  <?php  } ?>
        </tbody>
</table>
</body>
</html>
