<?php
session_start();
require_once "../../config/conexao.php";
if (!isset($_SESSION["funcionario_id"])) {
header("Location: ../login/login.php");
exit; }
try {
$db_total_usuarios = $conexao->query("SELECT COUNT(*) FROM usuarios WHERE LOWER(status) = 'ativo'")->fetchColumn();
$db_novos_usuarios = $conexao->query("SELECT COUNT(*) FROM usuarios WHERE criado_em >= date_trunc('month', CURRENT_DATE)")->fetchColumn();
$db_total_planos = $conexao->query("SELECT COUNT(*) FROM planos")->fetchColumn();
$db_total_bloqueados = $conexao->query("SELECT COUNT(*) FROM bloqueados WHERE LOWER(status) = 'ativo'")->fetchColumn();
$atividades_recentes = $conexao->query(" SELECT 'Novo usuario cadastrado' AS acao, nome AS usuario, email AS detalhes, criado_em AS data_hora FROM usuarios WHERE criado_em IS NOT NULL UNION ALL SELECT 'Usuario bloqueado' AS acao, u.nome AS usuario, b.motivo AS detalhes, b.data_bloqueio AS data_hora FROM bloqueados b INNER JOIN usuarios u ON b.usuario_id = u.id ORDER BY data_hora DESC LIMIT 5 ")->fetchAll(PDO::FETCH_ASSOC);
$usuarios_por_mes = $conexao->query(" SELECT to_char(m.mes, 'Mon') AS mes, COUNT(u.id) AS total FROM generate_series(date_trunc('month', CURRENT_DATE) - interval '6 months', date_trunc('month', CURRENT_DATE), interval '1 month') AS m(mes) LEFT JOIN usuarios u ON date_trunc('month', u.criado_em) = m.mes GROUP BY m.mes ORDER BY m.mes ")->fetchAll(PDO::FETCH_ASSOC); }
catch (Exception $e) {
$db_total_usuarios = 0;
$db_novos_usuarios = 0;
$db_total_planos = 0;
$db_total_bloqueados = 0;
$atividades_recentes = [];
$usuarios_por_mes = []; }
$total_usuarios = (int) $db_total_usuarios;
$novos_usuarios = (int) $db_novos_usuarios;
$total_planos = (int) $db_total_planos;
$total_bloqueados = (int) $db_total_bloqueados;
$chart_labels = array_map(function ($item) {
return $item["mes"]; }, $usuarios_por_mes);
$chart_data = array_map(function ($item) {
return (int) $item["total"]; }, $usuarios_por_mes);
$page_active = 'dashboard';
$header_title = "Olá, " . ($_SESSION["funcionario_nome"] ?? "Administrador") . "! 👋";
$header_subtitle = "Bem-vindo ao sistema administrativo da Bodyfit.";
include __DIR__ . '/dashboard.view.php';
