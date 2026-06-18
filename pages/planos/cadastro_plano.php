<?php
require_once "../../config/conexao.php";
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
$nome = $_POST["nome"] ?? "";
$valor = $_POST["valor"] ?? 0;
$opcao_pagamentos = $_POST["opcao_pagamentos"] ?? "";
$sql = "INSERT INTO planos (nome, valor, opcao_pagamentos) VALUES (:nome, :valor, :opcao_pagamentos)";
$stmt = $conexao->prepare($sql);
$resultado = $stmt->execute([ ":nome" => $nome, ":valor" => $valor, ":opcao_pagamentos" => $opcao_pagamentos ]);
if ($resultado) {
header("Location: controle_planos.php?sucesso=1");
exit; } else {
header("Location: controle_planos.php?erro=1");
exit; }
?>
