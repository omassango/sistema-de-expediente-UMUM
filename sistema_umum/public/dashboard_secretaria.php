<?php
session_start();
require_once '../config/db.php';
require_once '../classes/Requerimento.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['tipo'] !== 'secretaria') {
    header("Location: login.php");
    exit;
}

$requerimento = new Requerimento($pdo);
$estado_filtro = $_GET['estado'] ?? null;
$lista = $requerimento->listarTodos($estado_filtro);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Secretaria - Gestão de Expedientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #f5f5f5; }
  </style>
</head>
<body>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">

  <h3 class="mb-3 text-danger">Painel da Secretaria - Requerimentos</h3>
  <a href="logout.php" class="btn btn-danger">Sair</a>


  </div>
  <!-- Filtro de estado -->
  <form method="GET" class="mb-3">
    <div class="row g-2 align-items-end">
      <div class="col-md-4">
        <label for="estado" class="form-label">Filtrar por estado</label>
        <select name="estado" class="form-select">
          <option value="">Todos</option>
          <option value="espera" <?= ($estado_filtro === 'espera') ? 'selected' : '' ?>>Em Espera</option>
          <option value="andamento" <?= ($estado_filtro === 'andamento') ? 'selected' : '' ?>>Em Andamento</option>
          <option value="concluido" <?= ($estado_filtro === 'concluido') ? 'selected' : '' ?>>Concluído</option>
        </select>
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-danger w-100">Filtrar</button>
      </div>
    </div>
  </form>

  <!-- Tabela -->
  <div class="card">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th>Estudante</th>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Data</th>
            <th>Estado</th>
            <th>Ação</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($lista as $req): ?>
          <tr>
            <td><?= htmlspecialchars($req['nome']) ?></td>
            <td><?= htmlspecialchars($req['tipo']) ?></td>
            <td><?= htmlspecialchars($req['descricao']) ?></td>
            <td><?= $req['data_submissao'] ?></td>
            <td>
              <span class="badge bg-<?= $req['estado'] === 'concluido' ? 'success' : ($req['estado'] === 'andamento' ? 'warning' : 'secondary') ?>">
                <?= ucfirst($req['estado']) ?>
              </span>
            </td>
            <td>
              <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalAtualizar"
                data-id="<?= $req['id'] ?>"
                data-estado="<?= $req['estado'] ?>"
                data-resposta="<?= htmlspecialchars($req['resposta_secretaria']) ?>">
                Actualizar
              </button>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAtualizar" tabindex="-1" aria-labelledby="modalAtualizarLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="processar_atualizacao.php" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAtualizarLabel">Actualizar Estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="modal-id">
        <div class="mb-3">
          <label for="modal-estado" class="form-label">Estado</label>
          <select name="estado" id="modal-estado" class="form-select" required>
            <option value="espera">Em Espera</option>
            <option value="andamento">Em Andamento</option>
            <option value="concluido">Concluído</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="modal-resposta" class="form-label">Resposta da Secretaria</label>
          <textarea name="resposta" id="modal-resposta" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Actualizar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Preencher modal com dados do botão
const modal = document.getElementById('modalAtualizar');
modal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  document.getElementById('modal-id').value = button.getAttribute('data-id');
  document.getElementById('modal-estado').value = button.getAttribute('data-estado');
  document.getElementById('modal-resposta').value = button.getAttribute('data-resposta');
});
</script>
</body>
</html>
