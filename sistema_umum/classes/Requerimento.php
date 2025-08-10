<?php

class Requerimento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function criar($tipo, $descricao, $usuario_id) {
        $sql = "INSERT INTO requerimentos (tipo, descricao, data_submissao, estado, usuario_id) 
                VALUES (?, ?, NOW(), 'espera', ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$tipo, $descricao, $usuario_id]);
    }

    public function listarPorUsuario($usuario_id) {
        $sql = "SELECT * FROM requerimentos WHERE usuario_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    

    public function listarTodos($estado = null) {
        $sql = "SELECT r.*, u.nome FROM requerimentos r JOIN usuarios u ON r.usuario_id = u.id";

        if ($estado) {
            $sql .= " WHERE estado = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$estado]);
        } else {
            $stmt = $this->pdo->query($sql);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarEstado($id, $estado, $resposta = null) {
        $sql = "UPDATE requerimentos SET estado = ?, resposta_secretaria = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$estado, $resposta, $id]);
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">Página Inicial - Gestão de Expediente</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
	</div>
</nav>
