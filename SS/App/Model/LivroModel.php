<?php
class LivroModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Model para listar Livros
    public function listarLivros() {
        $sql = "SELECT L.*, CL.nome AS categoria_nome FROM livros L 
                INNER JOIN categoria_livros CL ON L.categoria_id = CL.id 
                ORDER BY CL.id ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function consultarQuantidade($livroID) {
        $consultaLivro = $this->pdo->prepare("SELECT quantidade FROM livros WHERE livro_id = ?");
        $consultaLivro->execute([$livroID]);
        return $consultaLivro->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarQuantidade($livroID, $novaQuantidade) {
        $atualizarQuantidade = $this->pdo->prepare("UPDATE livros SET quantidade = ? WHERE livro_id = ?");
        $atualizarQuantidade->execute([$novaQuantidade, $livroID]);
    }
    public function listarLivrosPorCategoria($categoria_livros) {
        $sql = "SELECT * FROM livros WHERE categoria_id = :categoria_livros";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':categoria_livros', $categoria_livros, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }    
}
?>