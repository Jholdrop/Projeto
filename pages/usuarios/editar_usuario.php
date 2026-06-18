<?php
session_start();
require_once "../../config/conexao.php";
require_once "foto_usuario_helper.php";
if (!isset($_SESSION["funcionario_id"])) {
header("Location: ../login/login.php");
exit; }
$id = $_GET['id'] ?? 0;
$id = intval($id);
garantir_coluna_foto_usuario($conexao);
$sql = "SELECT * FROM usuarios WHERE id = $id";
$resultado = $conexao->query($sql);
$usuario = $resultado->fetch(PDO::FETCH_ASSOC);
if (!$usuario) {
header("Location: gerenciamento_usuarios.php");
exit; }
try {
$planos = $conexao->query("SELECT * FROM planos ORDER BY id")->fetchAll(PDO::FETCH_ASSOC); }
catch (Exception $e) {
$planos = []; }
if (empty($planos)) {
$planos = [ ['id' => 1, 'nome' => 'Mensal'], ['id' => 2, 'nome' => 'Semestral'], ['id' => 3, 'nome' => 'Anual'] ]; }
$page_active = 'gerenciamento';
$header_title = "Editar usuário";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a>
<span class="divider">></span>
<a href="gerenciamento_usuarios.php">Gerenciamento de usuários</a>
<span class="divider">></span>
<span class="current">Editar usuário</span></div>';
include __DIR__ . '/editar_usuario.view.php';
