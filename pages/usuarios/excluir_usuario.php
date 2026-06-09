<?php
require_once "../../config/conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = $id";

$result = $conexao->query($sql);

if ($result) {
    header("Location: gerenciamento_usuarios.php");
    exit;
} else {
    echo "Erro ao remover usuário.";
}
?>

