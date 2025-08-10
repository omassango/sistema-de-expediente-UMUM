<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Usuario.php';

$usuario = new Usuario($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $usuario->criar($nome, $senha, $tipo);
    header("Location: cadastrar_usuario.php?sucesso=1");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Usuário</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h3>Cadastrar Novo Usuário</h3>

  <?php if (isset($_GET['sucesso'])): ?>
    <div class="alert alert-success">Usuário cadastrado com sucesso!</div>
  <?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label>Nome</label>
      <input type="text" name="nome" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Senha</label>
      <input type="password" name="senha" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Tipo de Usuário</label>
      <select name="tipo" class="form-select" required>
        <option value="">-- Selecione --</option>
        <option value="estudante">Estudante</option>
        <option value="secretaria">Secretaria</option>
      </select>
    </div>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
  </form>
</div>
</body>
</html>
