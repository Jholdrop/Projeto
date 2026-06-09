<?php
require_once "../../config/conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM usuarios WHERE id = 6";

$result = $conexao->query($sql);

if ($result) {
    echo "Usuário Removido com sucesso!";
} else {
    echo "Erro ao remover usuário.";
}
?>
?>

