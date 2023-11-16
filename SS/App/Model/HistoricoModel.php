<?php
class HistoricoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Model para listar o historico
    public function listarHistorico($usuarioId) {
        $sql = "SELECT livros.nome as livro_nome, emprestimos.data_emprestimo
                FROM emprestimos
                INNER JOIN livros ON emprestimos.livro_emprestimo = livros.livro_id
                WHERE emprestimos.aluno_emprestimo = :usuarioId";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
