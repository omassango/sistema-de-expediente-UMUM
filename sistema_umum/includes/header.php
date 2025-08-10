<?php
// Verifica se o usuário está logado
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand" href="painel.php">
      <img src="assets/img/logo-umum.png" alt="UMUM" width="40" class="me-2">
      Sistema de Expedientes - UMUM
    </a>
    <div class="d-flex">
      <a href="painel.php" class="btn btn-outline-primary me-2">Página Inicial</a>
      <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>
  </div>
</nav>
