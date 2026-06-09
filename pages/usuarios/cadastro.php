<?php 
require_once "../../config/conexao.php";
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}
$email = $_POST["email"];
$cpf = $_POST["cpf"];
$telefone = $_POST["telefone"];
$cep = $_POST["cep"];
$numero = $_POST["numero"];
$nome = $_POST["nome"];
$plano_id = $_POST["plano_id"];
$endereco = $_POST["endereco"] ?? "";
$status = $_POST["status"] ?? "ativo";

// Limpar caracteres não numéricos do CPF antes de salvar
$cpf_limpo = preg_replace('/\D/', '', $cpf);

$sql = "INSERT INTO usuarios (email, cpf, telefone, cep, numero, nome, plano_id, endereco, status) 
        VALUES ('$email', '$cpf_limpo', '$telefone', '$cep', '$numero', '$nome', '$plano_id', '$endereco', '$status')";
$result = $conexao->query($sql);

if ($result) {
    header("Location: gerenciamento_usuarios.php");
    exit;
} else {
    echo "Erro ao cadastrar usuário.";
}
?>