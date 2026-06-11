<?php

function garantir_coluna_foto_usuario(PDO $conexao): void
{
    $conexao->exec("ALTER TABLE usuarios ADD COLUMN IF NOT EXISTS foto VARCHAR(255)");
}

function salvar_foto_usuario(array $arquivo): ?string
{
    if (empty($arquivo["tmp_name"]) || $arquivo["error"] === UPLOAD_ERR_NO_FILE) {
        return null;
    }

    if ($arquivo["error"] !== UPLOAD_ERR_OK || $arquivo["size"] > 2 * 1024 * 1024) {
        return null;
    }

    $mime = mime_content_type($arquivo["tmp_name"]);
    $extensoes = [
        "image/jpeg" => "jpg",
        "image/png" => "png",
        "image/webp" => "webp"
    ];

    if (!isset($extensoes[$mime])) {
        return null;
    }

    $pasta = __DIR__ . "/../../assets/img/usuarios";
    if (!is_dir($pasta)) {
        mkdir($pasta, 0775, true);
    }

    $nomeArquivo = "usuario_" . uniqid("", true) . "." . $extensoes[$mime];
    $destino = $pasta . "/" . $nomeArquivo;

    if (!move_uploaded_file($arquivo["tmp_name"], $destino)) {
        return null;
    }

    return "/assets/img/usuarios/" . $nomeArquivo;
}
