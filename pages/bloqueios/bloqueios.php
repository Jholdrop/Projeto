<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
    header("Location: /pages/login/login.php");
    exit;
}

require_once "../../config/conexao.php";

$usuario_id = (int) ($_POST["usuario_id"] ?? 0);
$acao = $_POST["acao"] ?? "";
$motivo = trim($_POST["motivo"] ?? "Bloqueio manual");
$voltar = $_SERVER["HTTP_REFERER"] ?? "controle_bloqueios.php";

if ($usuario_id <= 0 || !in_array($acao, ["bloquear", "desbloquear"], true)) {
    header("Location: " . $voltar);
    exit;
}

try {
    $conexao->beginTransaction();

    if ($acao === "bloquear") {
        $stmt = $conexao->prepare("UPDATE usuarios SET status = 'inativo' WHERE id = :usuario_id");
        $stmt->execute([":usuario_id" => $usuario_id]);

        $stmt = $conexao->prepare("
            INSERT INTO bloqueados (usuario_id, status, motivo)
            VALUES (:usuario_id, 'ativo', :motivo)
        ");
        $stmt->execute([
            ":usuario_id" => $usuario_id,
            ":motivo" => $motivo !== "" ? $motivo : "Bloqueio manual"
        ]);
    }

    if ($acao === "desbloquear") {
        $stmt = $conexao->prepare("UPDATE usuarios SET status = 'ativo' WHERE id = :usuario_id");
        $stmt->execute([":usuario_id" => $usuario_id]);

        $stmt = $conexao->prepare("UPDATE bloqueados SET status = 'revogado' WHERE usuario_id = :usuario_id AND status = 'ativo'");
        $stmt->execute([":usuario_id" => $usuario_id]);
    }

    $conexao->commit();
} catch (Exception $e) {
    if ($conexao->inTransaction()) {
        $conexao->rollBack();
    }
}

header("Location: " . $voltar);
exit;
