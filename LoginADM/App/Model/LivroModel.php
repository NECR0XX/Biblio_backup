<?php
class LivroModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Model para criar Livros
    public function criarLivro($nome, $categoria, $quantidade) {
        $sql = "INSERT INTO livros (nome, categoria, quantidade) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $categoria, $quantidade]);
    }

    // Model para listar Livros
    public function listarLivros() {
        $sql = "SELECT * FROM livros";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Model para atualizar Livros
    public function atualizarLivro($livro_id, $nome, $categoria, $quantidade){
        $sql = "UPDATE livros SET nome = ?, categoria = ?, quantidade = ? WHERE livro_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nome, $categoria, $quantidade, $livro_id]);
    }
    
    // Model para deletar Livro
    public function excluirLivro($livro_id) {
        $sql = "DELETE FROM livros WHERE livro_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$livro_id]);
    }
    
}
?>