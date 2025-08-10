<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Requerimento.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'estudante') {
    header("Location: login.php");
    exit;
}

$requerimento = new Requerimento($pdo);
$usuario_id = $_SESSION['usuario']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    $requerimento->criar($tipo, $descricao, $usuario_id);
    header("Location: dashboard_estudante.php");
    exit;
}

$meus_requerimentos = $requerimento->listarPorUsuario($usuario_id);
?>
<!DOCTYPE html>
<html lang="pt">
<head>

  <meta charset="UTF-8">
  <title>Estudante - Gestão de Expedientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .bg-orange {
      background-color: #ff4b2b !important;
    }
    .btn-orange {
      background-color: #ff4b2b;
      color: white;
    }
    .btn-orange:hover {
      background-color: #ff4b2b;
      color: white;
    }
  </style>
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
  <h3 class="text-orange">Bem vindo, <?= $_SESSION['usuario']['nome'] ?> </h3>
  <a href="logout.php" class="btn btn-danger">Sair</a>
</div>

  <div class="card mb-4">
    <div class="card-header bg-success text-white">Submeter novo documento</div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label for="tipo" class="form-label">Selecione o Tipo de Documento a Requerer</label>
          <select name="tipo" class="form-select" required>
            <option value="">-- Selecione aqui --</option>
            <option>Declaração</option>
            <option>Certificado</option>
            <option>Credencial</option>
            <option>Anulação de Matrícula</option>
            <option>Declaração de Frequência</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="descricao" class="form-label">Descrição</label>
          <textarea name="descricao" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submeter</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header bg-success text-white">Lista de Documentos</div>
    <div class="card-body table-responsive">
      <table class="table table-bordered">
        <thead class="table-light">
          <tr>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Estado</th>
            <th>Resposta da Secretaria</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($meus_requerimentos as $req): ?>
          <tr>
            <td><?= htmlspecialchars($req['tipo']) ?></td>
            <td><?= htmlspecialchars($req['descricao']) ?></td>
            <td><?= $req['data_submissao'] ?></td>
            <td><span class="badge bg-<?= $req['estado'] === 'concluido' ? 'success' : ($req['estado'] === 'andamento' ? 'warning' : 'secondary') ?>">
              <?= ucfirst($req['estado']) ?></span></td>
            <td><?= htmlspecialchars($req['resposta_secretaria']) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</body>
</html>
