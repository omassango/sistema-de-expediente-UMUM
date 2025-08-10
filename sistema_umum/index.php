<?php
session_start();

// Se o usuário já estiver logado, redireciona para o painel
if (isset($_SESSION['usuario_id'])) {
    header('Location: painel.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestão de Expedientes - UMUM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Sistema de Gestão de Expediente</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
	</div>
</nav>

<body class="bg-light">

<div class="container text-center mt-5">
    <img src="img/logo-umum.png" alt="Logo UMUM" width="120" class="mb-4">
    <h1 class="mb-5">Sistema de Gestão de Expedientes - UMUM</h1>
    <a href="public/login.php" class="btn btn-danger">Entrar no Sistema</a>
</div>

</body>
</html>
