<?php
require_once "../../config/conexao.php";
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
$id = (int) ($_GET["id"] ?? 0);
try {
$sql = "DELETE FROM planos WHERE id = :id";
$stmt = $conexao->prepare($sql);
$resultado = $stmt->execute([":id" => $id]);
if ($resultado) {
header("Location: controle_planos.php?sucesso=1");
exit; } }
catch (Exception $e) {
header("Location: controle_planos.php?erro=1");
exit; }
header("Location: controle_planos.php?erro=1");
exit;
?>
