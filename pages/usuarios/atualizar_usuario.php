<?php 
require_once "../../config/conexao.php";
require_once "foto_usuario_helper.php";
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}

$id = (int) ($_POST["id"] ?? 0);
$nome = $_POST["nome"] ?? "";
$cpf = preg_replace('/\D/', '', $_POST["cpf"] ?? "");
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$cep = $_POST["cep"] ?? "";
$numero = $_POST["numero"] ?? "";
$plano_id = $_POST["plano_id"] ?? null;
$status = $_POST["status"] ?? "ativo";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";
$foto = salvar_foto_usuario($_FILES["foto_usuario"] ?? []);

garantir_coluna_foto_usuario($conexao);

$sql = "UPDATE usuarios SET 
    nome = :nome,
    cpf = :cpf,
    email = :email,
    telefone = :telefone,
    cep = :cep,
    numero = :numero,
    plano_id = :plano_id,
    status = :status,
    cidade = :cidade,
    estado = :estado";

$params = [
    ":nome" => $nome,
    ":cpf" => $cpf,
    ":email" => $email,
    ":telefone" => $telefone,
    ":cep" => $cep,
    ":numero" => $numero,
    ":plano_id" => $plano_id,
    ":status" => $status,
    ":cidade" => $cidade,
    ":estado" => $estado,
    ":id" => $id
];

if ($foto) {
    $sql .= ", foto = :foto";
    $params[":foto"] = $foto;
}

$sql .= " WHERE id = :id";

$resultado = $conexao->prepare($sql)->execute($params);

if ($resultado) {
    header("Location: gerenciamento_usuarios.php");
    exit;
} else {
    echo "Erro ao atualizar usuário.";
}
?>
