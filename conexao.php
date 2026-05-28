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
    echo "Conexão com o Postgres OK! <br>";
} catch (PDOException $e) {
    echo "Erro" . $e->getMessage();
}
?>