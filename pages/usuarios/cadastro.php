<?php 
require_once "../../config/conexao.php";
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.html");
    exit;
}
$email =  $_POST["email"];
$cpf =  $_POST["cpf"];
$telefone =  $_POST["telefone"];
$cep = $_POST["cep"];
$numero = $_POST["numero"];
$nome = $_POST["nome"];
$plano_id = $_POST["plano_id"];

$sql = "INSERT INTO usuarios (email, cpf, telefone, cep, numero, nome, plano_id) VALUES ('$email', '$cpf', '$telefone', '$cep','$numero', '$nome', '$plano_id')";
$result = $conexao->query($sql);

if ($result) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar usuário.";
}
?>