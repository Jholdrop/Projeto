<?php
session_start();

if (!isset($_SESSION["funcionario_id"])) {
header("Location: /pages/login/login.php");
exit;
} else {
header("Location: /pages/dashboard/dashboard.php");
exit;
}
?>
