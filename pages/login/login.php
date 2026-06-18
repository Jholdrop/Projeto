<?php
session_start();
if (isset($_SESSION["funcionario_id"])) {
header("Location: ../dashboard/dashboard.php");
exit; }
include __DIR__ . '/login.view.php';
