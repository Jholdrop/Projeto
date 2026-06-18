<?php
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
require_once "../../config/conexao.php";
try {
$sql = "SELECT * FROM planos ORDER BY id";
$resultado = $conexao->query($sql)->fetchAll(PDO::FETCH_ASSOC); }
catch (Exception $e) {
$resultado = []; }
$mensagem = "";
$mensagem_classe = "badge-ativo";
if (isset($_GET["sucesso"])) {
$mensagem = "Operacao realizada com sucesso."; }
if (isset($_GET["erro"])) {
$mensagem = "Nao foi possivel concluir a operacao. Verifique se o plano esta vinculado a algum aluno ou pagamento.";
$mensagem_classe = "badge-inativo"; }
$page_active = 'planos';
$header_title = "Controle de Planos";
$header_subtitle = '<div class="breadcrumb"><a href="../dashboard/dashboard.php">Home</a>
<span class="divider">></span>
<span class="current">Controle de planos</span></div>';
include __DIR__ . '/controle_planos.view.php';
