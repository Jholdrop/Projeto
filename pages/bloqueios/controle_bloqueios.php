<?php
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
require_once "../../config/conexao.php";
try {
$usuarios_ativos = $conexao->query("SELECT id, nome FROM usuarios WHERE LOWER(status) = 'ativo' ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$sql = " SELECT bloqueados.id, bloqueados.usuario_id, usuarios.nome, bloqueados.data_bloqueio, bloqueados.status, bloqueados.motivo FROM bloqueados INNER JOIN usuarios ON bloqueados.usuario_id = usuarios.id ORDER BY bloqueados.data_bloqueio DESC ";
$resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC); }
catch (Exception $e) {
$resultado = [];
$usuarios_ativos = []; }
$page_active = 'bloqueios';
$header_title = "Controle de Bloqueios";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a>
<span class="divider">></span>
<span class="current">Controle de bloqueios</span></div>';
include __DIR__ . '/controle_bloqueios.view.php';
