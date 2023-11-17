<?php
class EmprestimoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function emprestarLivro($livroID, $livroNome, $usuarioNome) {
        $consultaLivro = $this->pdo->prepare("SELECT quantidade FROM livros WHERE livro_id = ?");
        $consultaLivro->execute([$livroID]);
        $livro = $consultaLivro->fetch(PDO::FETCH_ASSOC);

        if ($livro && $livro['quantidade'] > 0) {
            $novaQuantidade = $livro['quantidade'] - 1;
            $this->atualizarQuantidade($livroID, $novaQuantidade);

            $inserirEmprestimo = $this->pdo->prepare("INSERT INTO emprestimos (livro_emprestimo, nome_livro, aluno_emprestimo, data_emprestimo) VALUES (?, ?, ?, NOW())");
            $inserirEmprestimo->execute([$livroID, $livroNome, $usuarioNome]);

            return true;
        }

        return false;
    }

    public function devolverLivro($emprestimoID) {
        $consultaEmprestimo = $this->pdo->prepare("SELECT livro_emprestimo FROM emprestimos WHERE emprestimo_id = ?");
        $consultaEmprestimo->execute([$emprestimoID]);
        $emprestimo = $consultaEmprestimo->fetch(PDO::FETCH_ASSOC);
    
        if ($emprestimo) {
            $livroID = $emprestimo['livro_emprestimo'];
    
            $consultaLivro = $this->pdo->prepare("SELECT quantidade FROM livros WHERE livro_id = ?");
            $consultaLivro->execute([$livroID]);
            $livro = $consultaLivro->fetch(PDO::FETCH_ASSOC);
    
            if ($livro) {
                $novaQuantidade = $livro['quantidade'] + 1;
                $this->atualizarQuantidade($livroID, $novaQuantidade);
    
                $excluirEmprestimo = $this->pdo->prepare("DELETE FROM emprestimos WHERE emprestimo_id = ?");
                $excluirEmprestimo->execute([$emprestimoID]);
    
                return true;
            }
        }
    
        return false;
    }

    private function atualizarQuantidade($livroID, $novaQuantidade) {
        $atualizarQuantidade = $this->pdo->prepare("UPDATE livros SET quantidade = ? WHERE livro_id = ?");
        $atualizarQuantidade->execute([$novaQuantidade, $livroID]);
    }
    public function listarLivrosEmprestados($usuarioNome) {
        $consultaLivrosEmprestados = $this->pdo->prepare("SELECT * FROM emprestimos WHERE aluno_emprestimo = ?");
        $consultaLivrosEmprestados->execute([$usuarioNome]);

        return $consultaLivrosEmprestados->fetchAll(PDO::FETCH_ASSOC);
    }
    public function listarLivrosEmprestadosprID($usuarioNome) {
        $listarLivrosEmprestadosprID = $this->pdo->prepare("SELECT * FROM emprestimos WHERE aluno_emprestimo = ?");
        $listarLivrosEmprestadosprID->execute([$usuarioNome]);

        return $consultaLivrosEmprestados->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
