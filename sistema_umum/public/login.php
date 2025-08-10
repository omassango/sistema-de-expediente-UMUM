<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Usuario.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = new Usuario($pdo);
    $dados = $usuario->autenticar($email, $senha);

    if ($dados) {
        $_SESSION['usuario'] = $dados;
        if ($dados['tipo'] === 'estudante') {
            header("Location: dashboard_estudante.php");
        } else {
            header("Location: dashboard_secretaria.php");
        }
        exit;
    } else {
        $erro = "Credenciais inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Login - Gestão de Expedientes</title>
  <link rel="icon" href="../img/favicon-umum.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #ff4b2b, #ff4b2b);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-container {
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      padding: 30px;
      width: 100%;
      max-width: 400px;
    }

    .form-title {
      color: #000000;
    }

    .btn-primary {
      background-color: #ff4b2b;
      border: none;
    }

    .btn-primary:hover {
      background-color: rgb(156, 29, 7);
    }
  </style>
</head>
<body>

  <div class="login-container">
  <div align="center" class="mb-2">
    <img src="../img/logo-umum.png" width="100">
	</div>
    <h3 class="form-title text-center mb-4">Gestão de Expedientes - UMUM</h3>

    <?php if (!empty($erro)) : ?>
      <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
      <label for="email" class="form-label"></label>
        <input type="email" name="email" placeholder="E-mail" class="form-control" required>
      </div>

      <div class="mb-3">
      <label for="email" class="form-label"></label>
        <input type="password" name="senha" placeholder="Senha" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Entrar</button>
    </form>
  </div>

</body>
</html>
