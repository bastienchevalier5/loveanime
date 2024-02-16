<?php
$host = "192.168.1.27";
$db = "loveanime";
$user = "root";
$pass = "";
$port = 3306;
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";
$pdo = new PDO($dsn, $user, $pass);
?>