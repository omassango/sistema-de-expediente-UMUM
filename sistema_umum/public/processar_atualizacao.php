<?php
require_once '../config/db.php';
require_once '../classes/Requerimento.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $resposta = $_POST['resposta'];

    $requerimento = new Requerimento($pdo);
    $requerimento->atualizarEstado($id, $estado, $resposta);

    header("Location: dashboard_secretaria.php");
    exit;
}
?>
