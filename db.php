<?php
$host = '127.0.0.1';
$dbname = 'construcao';
$username = 'root';  // Ajuste conforme seu banco de dados
$password = 'F6KiGI678uvO7aB81OV6DaX6c878Ko';      // Ajuste conforme seu banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
