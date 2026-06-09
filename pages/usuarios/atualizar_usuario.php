<?php 
require_once "../../config/conexao.php";

$id = $_POST["id"];
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$cep = $_POST["cep"];
$numero = $_POST["numero"];
$plano_id = $_POST["plano_id"];

$sql = "UPDATE usuarios SET 
    nome = '$nome',
    cpf = '$cpf',
    email = '$email',
    telefone = '$telefone',
    cep = '$cep',
    numero = '$numero',
    plano_id = $plano_id
WHERE id = $id";

$resultado = $conexao->query($sql);

if ($resultado) {
    header("Location: gerenciamento_usuarios.php");
    exit;
} else {
    echo "Erro ao atualizar usuário.";
}
?>