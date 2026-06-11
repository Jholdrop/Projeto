<?php
session_start();

require_once "../../config/conexao.php";

$cpf = $_POST["cpf"] ?? "";
$senha = $_POST["senha"] ?? "";

$sql = "SELECT * FROM funcionarios 
        WHERE cpf = :cpf 
        AND senha = :senha";

$resultado = $conexao->prepare($sql);
$resultado->execute([
    ":cpf" => $cpf,
    ":senha" => $senha
]);

$funcionario = $resultado->fetch(PDO::FETCH_ASSOC);

if ($funcionario) {
    $_SESSION["funcionario_id"] = $funcionario["id"];
    $_SESSION["funcionario_nome"] = $funcionario["nome"];
    $_SESSION["funcionario_cargo"] = $funcionario["cargo"];

    header("Location: ../dashboard/dashboard.php");
    exit;
} else {
    header("Location: login.php?erro=1");
    exit;
}
?>
