<?php 
require_once "../../config/conexao.php";

$email =  $_POST["email"];
$cpf =  $_POST["cpf"];
$telefone =  $_POST["telefone"];
$endereco =  $_POST["endereco"];
$nome = $_POST["nome"];
$plano_id = $_POST["plano_id"];

$sql = "INSERT INTO usuarios (email, cpf, telefone, endereco, nome, plano_id) VALUES ('$email', '$cpf', '$telefone', '$endereco', '$nome', '$plano_id')";
$result = $conexao->query($sql);

if ($result) {
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar usuário.";
}
?>