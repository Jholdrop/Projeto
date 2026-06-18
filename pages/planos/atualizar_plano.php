<?php
require_once "../../config/conexao.php";
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
$id = (int) ($_POST["id"] ?? 0);
$nome = $_POST["nome"] ?? "";
$valor = $_POST["valor"] ?? 0;
$opcao_pagamentos = $_POST["opcao_pagamentos"] ?? "";
$sql = "UPDATE planos SET nome = :nome, valor = :valor, opcao_pagamentos = :opcao_pagamentos WHERE id = :id";
$stmt = $conexao->prepare($sql);
$resultado = $stmt->execute([ ":nome" => $nome, ":valor" => $valor, ":opcao_pagamentos" => $opcao_pagamentos, ":id" => $id ]);
if ($resultado) {
header("Location: controle_planos.php?sucesso=1");
exit; } else {
header("Location: controle_planos.php?erro=1");
exit; }
?>
