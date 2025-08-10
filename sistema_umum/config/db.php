<?php
$host = 'localhost';
$db = 'umum_expedientes';
$usuario = 'root';
$senha = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
