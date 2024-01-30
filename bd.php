<?php
$host = "127.0.0.1";
$db = "compte_loveanime";
$user = "root";
$pass = "";
$port = 3306;
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
$pdo = new PDO($dsn, $user, $pass);
?>