<?php
class LivroModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Model para listar Livros
    public function listarLivros() {
        $sql = "SELECT * FROM livros";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>