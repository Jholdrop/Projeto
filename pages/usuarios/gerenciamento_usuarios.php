<?php
session_start();
require_once "../../config/conexao.php";
require_once "foto_usuario_helper.php";
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
try {
garantir_coluna_foto_usuario($conexao);
$sql = "SELECT u.*, p.nome as plano_nome FROM usuarios u LEFT JOIN planos p ON u.plano_id = p.id ORDER BY u.id DESC";
$resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC); }
catch (Exception $e) {
$resultado = []; }
$page_active = 'gerenciamento';
$header_title = "Gerenciamento de usuários";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a>
<span class="divider">></span>
<span class="current">Gerenciamento de usuários</span></div>';
include __DIR__ . '/gerenciamento_usuarios.view.php';
