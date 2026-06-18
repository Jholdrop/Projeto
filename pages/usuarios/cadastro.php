<?php
require_once "../../config/conexao.php";
require_once "foto_usuario_helper.php";
session_start();
if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit; }
$email = $_POST["email"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$numero = $_POST["numero"] ?? "";
$nome = $_POST["nome"] ?? "";
$plano_id = $_POST["plano_id"] ?? null;
$status = $_POST["status"] ?? "ativo";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$cpf_limpo = preg_replace('/\D/', '', $cpf);
$foto = salvar_foto_usuario($_FILES["foto_usuario"] ?? []);
garantir_coluna_foto_usuario($conexao);
$sql = "INSERT INTO usuarios (email, cpf, telefone, cep, numero, nome, plano_id, cidade, status, estado, foto) VALUES (:email, :cpf, :telefone, :cep, :numero, :nome, :plano_id, :cidade, :status, :estado, :foto)";
$stmt = $conexao->prepare($sql);
$result = $stmt->execute([ ":email" => $email, ":cpf" => $cpf_limpo, ":telefone" => $telefone, ":cep" => $cep, ":numero" => $numero, ":nome" => $nome, ":plano_id" => $plano_id, ":cidade" => $cidade, ":status" => $status, ":estado" => $estado, ":foto" => $foto ]);
if ($result) {
header("Location: gerenciamento_usuarios.php");
exit; } else {
echo "Erro ao cadastrar usuário."; }
?>
