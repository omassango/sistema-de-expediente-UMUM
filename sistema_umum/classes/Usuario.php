<?php
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function autenticar($email, $senha) {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $senha]);
    
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }
}      
?>