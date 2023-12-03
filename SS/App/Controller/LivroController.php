<?php
require_once 'App/Model/LivroModel.php';


class LivroController {
    private $livroModel;

    public function __construct($pdo) {

        $this->livroModel = new LivroModel($pdo);
    }

    public function listarLivros() {
        return $this->livroModel->listarLivros();
    }
    public function listarLivrosPorCategoria($categoria_livros) {
        $livros = $this->livroModel->listarLivrosPorCategoria($categoria_livros);
        return $livros;
    }
}
?>