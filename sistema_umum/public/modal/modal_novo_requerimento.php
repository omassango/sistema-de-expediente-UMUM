<!-- Modal de Novo Requerimento -->
<div class="modal fade" id="modalRequerimento" tabindex="-1" aria-labelledby="modalRequerimentoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="../acoes/salvar_requerimento.php">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Novo Requerimento</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Tipo de Requerimento</label>
            <select name="tipo" class="form-select" required>
              <option value="">Selecione...</option>
              <option>Declaração</option>
              <option>Certificado</option>
              <option>Credencial</option>
              <option>Anulação de Matrícula</option>
              <option>Declaração de Frequência</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="3" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submeter</button>
        </div>
      </div>
    </form>
  </div>
</div>
