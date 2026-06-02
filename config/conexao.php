<?php

$host = "localhost";
$dbaname = "academia_bd";
$user = "postgres";
$password = "postgres";

try {
    $conexao = new PDO(
        "pgsql:host=$host;dbname=$dbaname",
        $user,
        $password
    );
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();
}
?>