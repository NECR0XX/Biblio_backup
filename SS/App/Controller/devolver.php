<?php
session_start();
require_once '../../../Config/config.php';

if (isset($_POST['devolver'])) {
    $livroID = $_POST['livro_id'];

    $consultaLivro = $pdo->prepare("SELECT quantidade FROM livros WHERE livro_id = ?");
    $consultaLivro->execute([$livroID]);
    $livro = $consultaLivro->fetch(PDO::FETCH_ASSOC);

    if ($livro) {
        $novaQuantidade = $livro['quantidade'] + 1;
        $atualizarQuantidade = $pdo->prepare("UPDATE livros SET quantidade = ? WHERE livro_id = ?");
        $atualizarQuantidade->execute([$novaQuantidade, $livroID]);
        
        foreach ($_SESSION['emprestimo'] as $key => $emprestimo) {
            if ($emprestimo['livro_id'] == $livroID) {
                unset($_SESSION['emprestimo'][$key]);
                echo "Livro devolvido com sucesso!";
                break;
            }
        }
    }
    header('Location: ../../book.php');
    exit();
}
?>
