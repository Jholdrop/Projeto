<?php
session_start();
require_once "../../config/conexao.php";
if (!isset($_SESSION["funcionario_id"])) {
header("Location: ../login/login.php");
exit; }
try {
$planos = $conexao->query("SELECT * FROM planos ORDER BY id")->fetchAll(PDO::FETCH_ASSOC); }
catch (Exception $e) {
$planos = []; }
if (empty($planos)) {
$planos = [ ['id' => 1, 'nome' => 'Mensal'], ['id' => 2, 'nome' => 'Semestral'], ['id' => 3, 'nome' => 'Anual'] ]; }
$page_active = 'cadastro';
$header_title = "Cadastro de usuários";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a>
<span class="divider">></span>
<span class="current">Cadastro de usuários</span></div>';
include __DIR__ . '/cadastro_usuarios.view.php';
