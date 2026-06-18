<?php
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
require_once "../../config/conexao.php";
$id = (int) ($_GET["id"] ?? 0);
$sql = "SELECT * FROM planos WHERE id = :id";
$stmt = $conexao->prepare($sql);
$stmt->execute([":id" => $id]);
$plano = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$plano) {
header("Location: controle_planos.php?erro=1");
exit; }
$page_active = 'planos';
$header_title = "Editar Plano";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a>
<span class="divider">></span>
<a href="controle_planos.php">Controle de planos</a>
<span class="divider">></span>
<span class="current">Editar plano</span></div>';
include __DIR__ . '/editar_plano.view.php';
