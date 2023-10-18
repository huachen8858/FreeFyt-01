<?php

$db_host = "localhost";
$db_name = "FreeFyt01";
$db_user = "root";
$db_pass = "";

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

$pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);

// 檢查每個頁面都要有session
if (!isset($_SESSION)) {
  session_start();
}